<?php

require 'framework/main.php';

$d = new CV_Document();
$d->add_page('data/content.json', 'sidebar', 'test.php');
// $d->add_page('data/content.json', 'sidebar');
// $d->add_custom_stylesheet('test.css');
$d->render();

?>