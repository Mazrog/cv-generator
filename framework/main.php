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
    public $pages           = array();
    public $styles          = array();
    public $custom_styles   = array();

    private function layout_exists($layout){
        /* Loading all the existing layouts */
        /* Listing the directories under the /layout dir */
        $layout_path = join(DIRECTORY_SEPARATOR, array(BASEPATH, 'layouts'));
        $layout_list = array_diff(scandir($layout_path), array('.', '..'));
        return in_array($layout, $layout_list);
    }

    public function add_page($data_file, $layout = "plain", $custom_template = null){
        if($this->layout_exists($layout)){
            $data_tab = json_decode(file_get_contents($data_file), true);
            $page = new Page($layout, $data_tab, $custom_template);

            array_push($this->pages, $page);
            array_push($this->styles, strtolower($layout));

            return $page;
        } else {
            echo "This layout does not exist : ${layout}";
        }
    }

    public function add_custom_stylesheet($stylesheet){
        $path = join(
            DIRECTORY_SEPARATOR,
            array(
                custom, 'css', $stylesheet
            )
        );
        $c = preg_match('/^(.+).css$/', $stylesheet, $match);
        if(c && file_exists($path)){
            array_push($this->custom_styles, $path);
        } else {
            echo "<code class='t-center'>The stylesheet you entered is either not supported or does not exist :<br/>${path}</code>";
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
        foreach($this->custom_styles as $sheet){
            array_push(
                $styles_link,
                "<link rel='stylesheet' href='${sheet}'/>"
            );
        }
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

    public function __construct($layout, $data, $custom_template = null){
        $this->data     = $data;

        if(is_null($custom_template)){
            $this->layout   = $layout;
            $this->template = (strtolower($layout).".php");
        } else {
            $path = join(
                DIRECTORY_SEPARATOR,
                array('custom', 'templates', $custom_template)
            );
            if(file_exists($path)){
                $this->layout   = 'custom';
                $this->template = $custom_template;
            } else {
                $this->layout   = 'utils';
                $this->template = '404.html';
            }
        }
    }

    public function render(){
        $data = $this->data;
        $arr_path = ($this->layout == 'custom')
                    ? array('custom', 'templates', $this->template)
                    : array(BASEPATH, 'layouts', $this->layout, $this->template);


        include join(DIRECTORY_SEPARATOR, $arr_path);
    }
}

?>