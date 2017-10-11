<?php

require 'framework/main.php';

$d = new CV_Document();
$d->add_page('data/content.json', 'sidebar');
$d->add_page('data/demo.json', 'sidebar');
// $d->add_custom_stylesheet('test.css');
$d->render();

?>