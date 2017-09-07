
<?php

session_start();

require('./resize.php');
require('./deletetmp.php');

$path = 'tmp/';


$Picture_max_width = 320;
$Picture_max_height = 240;






$types = array('image/gif', 'image/png', 'image/jpeg');

$size = 1024000;


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	if (!in_array($_FILES['picture']['type'], $types)) die('error|type_file');
		
	if ($_FILES['picture']['size'] > $size) die('error|max_size');
	
	if (isset($_POST['username'])) { $username = $_POST['username']; if ($username == '') { unset($username);} } 

    if (empty($username)) die('error|no_username');
    
    if (isset($_POST['textarea'])) { $textarea = $_POST['textarea']; if ($textarea == '') { unset($textarea);} } 

    if (empty($textarea)) die('error|no textarea');
    
		
    if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} } 

    if (empty($email)) die('error|format_email');

    if(!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email)) die('error|format_email');
		

	 
	 $pathSavePicture = $path . time().rand().'.jpg'; 
	 
	 

	
	 if(resizeToSave($_FILES['picture'],$pathSavePicture,$Picture_max_height,$Picture_max_width)){
	 	
	 	
	 $_SESSION['newtask_username'] = $username;
	 
	 $_SESSION['newtask_email'] = $email;	
	 
	 $_SESSION['newtask_textarea'] = $textarea;	
	 
	 $_SESSION['newtask_picture'] = $pathSavePicture;	 
	 	
	 
	 $username =	rawurlencode($username);
	 $textarea = 	rawurlencode($textarea);	
	 	
	 die('ok|'.$username.'|'.$email.'|'.$textarea.'|'.$pathSavePicture);	
	 	
	 }else
	 {
	 	
	 die('error|picture');	
	 }
		
		
		
}



?>