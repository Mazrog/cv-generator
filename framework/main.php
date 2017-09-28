<?php

define('BASEPATH', 'framework');

spl_autoload_register(function($class_name){
    $class_name = strtolower($class_name);
    $parts = array(
        BASEPATH,
        "layouts",
        $class_name,
        ($class_name."_class.php")
    );
    include join(DIRECTORY_SEPARATOR, $parts);
});


class CV_Document{
    public $pages   = array();
    public $styles  = array();

    private function layout_exists($layout){
        /* Loading all the existing layouts */
        /* Listing the directories under the /layout dir */
        $layout_path = join(DIRECTORY_SEPARATOR, array(BASEPATH, 'layouts'));
        $layout_list = array_diff(scandir($layout_path), array('.', '..'));
        return in_array($layout, $layout_list);
    }

    public function add_page($data_file, $layout = "plain"){
        if($this->layout_exists($layout)){
            $data_tab = json_decode(file_get_contents($data_file), true);
            $page = new Page($layout, $data_tab);

            array_push($this->pages, $page);
            array_push($this->styles, strtolower($layout));

            return $page;
        } else {
            echo "This layout does not exist : ${layout}";
        }
    }

    public function render(){
        /* Loading of the basic html template */
        $base = file_get_contents(
            join(DIRECTORY_SEPARATOR,
                array(
                    BASEPATH,
                    'templates',
                    'head.html'
                )
            )
        );
        /* Loading all the stylesheets */
        /* the base one and one for each layout */
        $styles_link = array("<link rel='stylesheet' href='framework/css/base.css'/>");
        foreach($this->styles as $layout){
            $path = join(
                DIRECTORY_SEPARATOR,
                array(
                    BASEPATH, 'layouts', $layout, ($layout.".css")
                )
            );
            array_push(
                $styles_link,
                "<link rel='stylesheet' href='${path}'/>"
            );
        }
        $base = preg_replace('/{{\s?styles\s?}}/', join('', $styles_link), $base);
        echo $base;
        /* Rendering each page in the body */
        foreach($this->pages as $page){
            $page->render();
        }
        /* Rendering the bottom of the page */
        echo file_get_contents(
            join(DIRECTORY_SEPARATOR,
                array(
                    BASEPATH,
                    'templates',
                    'tail.html'
                )
            )
        );
    }
}

class Page{
    public $layout   = "plain";
    public $data     = "";
    public $template = "plain.php";

    public function __construct($layout, $data){
        $this->layout   = $layout;
        $this->data     = $data;
        $this->template = (strtolower($layout).".php");
        echo "kappa";
    }

    public function render(){
        $data = $this->data;
        include join(
            DIRECTORY_SEPARATOR,
            array(
                BASEPATH,
                'layouts',
                $this->layout,
                $this->template
            )
            
        );
    }
}

?>