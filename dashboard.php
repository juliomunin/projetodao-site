<?php


use \Main\Dashboard;


$app->get('/dasboard', function () {

    $page = new PageDashboard();
    $page->setTpl("index");
    
       
    });
 
 ?>