<?php

session_start();

if (isset($_SESSION['newtask_picture'])){
	
	
	$tmp_picture = $_SESSION['newtask_picture'];
	$picture = basename($tmp_picture);
	$path = './pic';
	$picture = $path .'/'.$picture;
	
	if (copy($tmp_picture,$picture ))
	 {
	 	
	 	require("./bd/bd.php");


        $mysqli = new mysqli($bd_host, $bd_user, $bd_password, $bd_db);
        
        $username = $_SESSION['newtask_username'];
        $email    = $_SESSION['newtask_email'];
        $textarea = $_SESSION['newtask_textarea'];
        $status = 0;
        
        
        if ($mysqli->query ("INSERT INTO tasks VALUES(NULL,'$status','$username','$email','$textarea','$picture')")=='TRUE')
        {
         header("Location: index.php");
        }
	  }



     unset($_SESSION['newtask_username']);
	 unset($_SESSION['newtask_email']);
	 unset($_SESSION['newtask_textarea']);	
	 unset($_SESSION['newtask_picture']);
	
	
	
}





?>
