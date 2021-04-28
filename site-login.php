<?php

use \Main\Page;
use \Main\Validate;
use \Main\User;


$app->post('/login', function () {

    if( !isset( $_POST['deslogin'] )&& $_POST['deslogin'] != ''){
     
     header("Location: login");
     exit;

    }//end if


    if ( ( $deslogin = validate::validateEmail($_POST['deslogin']) )=== false){

        
        header("Location: login");
        exit;

    }//end if


    if( !isset( $_POST['despassword'] )&& $_POST['despassword'] != ''){

        header("Location: login");
     exit;     

    }//end if

    

    if ( ( $despassword = validate::validatePassword($_POST['despassword']) )=== false){

        
        header("Location: login");
        exit;

    }//end if

    User::login( $_POST['deslogin'], $_POST['despassword'] );

    header("/dasboard");
    exit;
    

    });





$app->get('/login', function () {

    $page = new Page();
    $page->setTpl("login");
    
       
    });

?>