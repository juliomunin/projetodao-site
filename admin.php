<?php

$app->get('/admin', function () {

    $page = new PageAdmin();
    $page->setTpl("index");
    
       
    });
 
?> 