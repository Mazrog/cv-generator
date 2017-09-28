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

    public function add_page($data_file, $layout = "plain"){
        if(class_exists($layout)){
            $data_tab = json_decode(file_get_contents($data_file), true);
            $page = new $layout($data_tab);

            array_push($this->pages, $page);
            array_push($this->styles, strtolower($layout));

            // return $page;
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

abstract class Page{
    protected $layout  = "plain";
    protected $data    = "";

    protected function __construct($data){
        $this->data = $data;
    }

    abstract protected function render();
}

?>