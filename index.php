<?php

require 'framework/main.php';

$d = new CV_Document();
$d->add_page('data/content.json', 'sidebar');
$d->render();

?>