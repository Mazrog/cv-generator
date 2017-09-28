<?php

class Sidebar extends Page{
    public function __construct($data){
        parent::__construct($data);
    }

    public function render(){
        $data = $this->data;
        include 'sidebar.php';
    }
}

?>