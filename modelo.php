<?php
session_start();
require_once("vendor/autoload.php");

use \Main\User;
use \Main\Page;
use \Main\PageAdmin;

$app = new \Slim\Slim();



$app->get('/exemplo2', function(){


   echo"<pre>";
   echo"Exemplo2";

   echo"<br><br>";

   var_dump($_SESSION);

   echo"<br><br>";

   echo$_SESSION[User::SESSION]['deslogin'];

   exit;


});

$app->get('/exemplo1', function() {

   
   $deslogin = '';

 
   if( isset( $_GET['deslogin'] )&& $_GET['deslogin'] != ''){
    $deslogin = $_GET['deslogin'];
   }
   else
   {
    header("Location: /");
    exit;
   }
 
   $user = new User();
   $user->getByDeslogin($deslogin);


   if ($user->getiduser() > 0){
      $_SESSION[User::SESSION] = [

         'iduser'=>$user->getiduser(),
         'deslogin'=>$user->getdeslogin(),
         'despassword'=>$user->getdespassword(),
         'dtregister'=>$user->getdtregister()

      ];
      echo"<pre>";
      var_dump($_SESSION);
      exit; 

  }
  else
  {

   echo "<pre>";
   echo "Este usuário não existe";
   echo '<a href="/">Voltar</a><br><br>';

  }
});






$app->get('/delete/:iduser', function($iduser) {

$user = new User();
$user->get((int)$iduser);

$user->delete();

header("Location: /");
exit;

});





$app->get('/update/:iduser', function($iduser) {

   $deslogin = '';
   $despassword = '';
 
   if( isset( $_GET['deslogin'] )&& $_GET['deslogin'] != ''){
    $deslogin = $_GET['deslogin'];
   }
 
   if( isset( $_GET['despassword'] )&& $_GET['despassword'] != ''){
    $despassword = $_GET['despassword'];
   }
   
   if( $deslogin == '' && $despassword == ''){
    header("Location: /");
    exit;
   }
 
   $user = new User();

   $user->get((int)$iduser);

   if ($user->getiduser() > 0){

      $deslogin = ($deslogin =='') ? $user->getdeslogin() : $deslogin;
      $despassword = ($despassword =='') ? $user->getdespassword() : $despassword;
   
   $results = $user->update((int)$user->getiduser(), $deslogin, $despassword );
 
   echo "<pre>";
   echo '<a href="/">Voltar</a><br><br>';
   print_r($results);
   exit;

  }
  else
  {

   echo "<pre>";
   echo "Este usuário não existe";
   echo '<a href="/">Voltar</a><br><br>';

  }
});







$app->get('/insert', function() {

  $deslogin = '';
  $despassword = '';

  if( isset( $_GET['deslogin'] )&& $_GET['deslogin'] != ''){
   $deslogin = $_GET['deslogin'];
  }

  if( isset( $_GET['despassword'] )&& $_GET['despassword'] != ''){
   $despassword = $_GET['despassword'];
  }
  
  if( $deslogin == '' || $despassword == ''){
   header("Location: /");
   exit;
  }

  $user = new User();
  $results = $user->save($deslogin, $despassword);

  echo "<pre>";
  echo '<a href="/">Voltar</a><br><br>';
  print_r($results);
  exit;

 });


$app->get('/select/:iduser', function ($iduser) {

  $user = new User();
  $user-> get((int)$iduser);
  
  
  echo "<pre>";

  echo '<a href="/">Voltar</a><br><br>';

  echo "iduser: ".$user ->getiduser()."<br>";
  echo "deslogin: ".$user ->getdeslogin()."<br>";
  echo "despassword: ".$user ->getdespassword()."<br>";
  echo "dtregister: ".$user ->getdtregister()."<br>";
  echo "<br>";
  echo "<br>";

  echo '<a onclick="return confirm(`Deseja excluir este item?`) "href="/delete/'.$user->getiduser().'">Deletar</a><br><br>';

});




$app->run();

?>