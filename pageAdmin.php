<?php

use \Main\PageAdmin;

$app->get('/admin', function () {

$page = new PageAdmin();
$page->setTpl("index");

   
});

?>