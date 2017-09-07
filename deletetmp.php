 <?php
 
 $path = './tmp';
  if ($handle = opendir($path)) {
 
    while (false !== ($file = readdir($handle))) {
    
      if (time()-filectime($path."/".$file) > 60*10) {  
        
        if (preg_match('/\.jpg$/i', $file)) {
            unlink($path.'/'.$file);
          }
          
        }
    }
  }
  
  ?>