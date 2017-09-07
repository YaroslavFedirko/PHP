<?php

function resizeToSave($file,$fileNameToSave,$max_h,$max_w,  $rotate = null, $quality = null)
	{
	
    
		if ($quality == null)
			$quality = 75;

		
		if ($file['type'] == 'image/jpeg')
			$source = imagecreatefromjpeg($file['tmp_name']);
		elseif ($file['type'] == 'image/png')
			$source = imagecreatefrompng($file['tmp_name']);
		elseif ($file['type'] == 'image/gif')
			$source = imagecreatefromgif($file['tmp_name']);
		else
			return false;
			
	
		if ($rotate != null)
			$src = imagerotate($source, $rotate, 0);
		else
			$src = $source;

	
	    	$w_src = imagesx($src); 
		    $h_src = imagesy($src);

	if ($w_src > $max_w || $h_src > $max_h)
		{
		
		if ($w_src > $max_w){ $w_dest = $max_w; }else{ $w_dest = $w_src;}
		if ($h_src > $max_h){ $h_dest = $max_h; }else{ $h_dest = $h_src;}
		
    	$dest = imagecreatetruecolor($w_dest, $h_dest);
			
			imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
            imagejpeg($dest, $fileNameToSave, $quality);
			imagedestroy($dest);
			imagedestroy($src);

			return true;
		}
		else
		{
			
			imagejpeg($src, $fileNameToSave, $quality);
			imagedestroy($src);

			return true;
		}
	}


?>