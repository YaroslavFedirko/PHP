<html>
	 <head>
		<meta charset="utf-8">
	  </head>
	  <body>
	  
	  <div id = "block_task_form">
	  <form name ="task_form" id = "task_form">
	  <table>
	  <tr>
	  <td COLSPAN = 2> Новая Задача </td>
	  </tr>
	  <tr>
	  <td>Имя пользователя: </td>
	  <td>  <input  name="username" /> </td>
	  </tr>
	  <tr>
	  <td>e-mail: </td>
	  <td>  <input  name="email" /> </td>
	  </tr>
      <tr>
	  <td>Текст Задачи: </td>
	  <td><textarea name="textarea"  rows="3" cols="20"></textarea> </td>
	  </tr>
	  <tr>
	  <td>Картинка: </td>
	  <td>   
	  <input name="picture" type="file" accept="image/*" >
      </td>
	  </tr>
	  <tr>
	  <td COLSPAN=2>
	  <input type='button' value='Предварительный просмотр'  onclick="preview()"> 
      </td>
	  </tr>
      </table>
      </form>
      </div>
      
      <div id = "block_preview" style="display: none">
      <table>
	  <tr>
	  <td COLSPAN = 2> Предварительный просмотр задачи </td>
	  </tr>
	  <tr>
	  <td>Имя пользователя: </td>
	  <td> <div id = 'preview_username'> </div> </td>
	  </tr>
	  <tr>
	  <td>e-mail: </td>
	  <td>  <div id = "preview_email"> </div></td>
	  </tr>
      <tr>
	  <td>Текст Задачи: </td>
	  <td><div id = "preview_textarea"> </div> </td>
	  </tr>
	  <tr>
	  <td>Картинка: </td>
	  <td>   
	  <img id="preview_picture">
      </td>
	  </tr>
	  <tr>
	  <td>
	  <input type='button' value='Назад'  onclick="Back()"> 
      </td>
	  <td>
	  <input type='button' value='сохранить задачу'  onclick="location.href='savetask.php';"> 
      </td>
	  </tr>
      </table>
      </div>
      
      
      
      
      
      
      <script>
      
       function go(id)
       {
	   return document.getElementById(id);	
	   }
      
      
        function showError(container, errorMessage) 
	   	   {
             container.className = 'error';
             var msgElem = document.createElement('div');
             msgElem.className = "error-message";
             msgElem.innerHTML = errorMessage;
             container.appendChild(msgElem);
           }
    
    
        function resetError(container) 
           {
             container.className = '';
            if (container.lastChild.className == "error-message") {
             container.removeChild(container.lastChild);
            }
           } 
           
           
           
           function sendForm(form,url,callback)
           {
           	
           		var form_data  = new FormData(form);
			
			    var xhr = new XMLHttpRequest();
			  
			    xhr.onload = xhr.onerror = function() {
			     if (this.status == 200) {

                callback(xhr.responseText);
              
               }}
              
                xhr.open('POST',url); 
		   	
		    	xhr.send(form_data);
		   	
		   	
		   }
      

        function  preview()
        {
        	
        	var r = true;
            
            var task_form = document.getElementById("task_form");

            var elems = task_form.elements;

                resetError(elems.username.parentNode);
                
               if (!elems.username.value) {
      	       r = false;
               showError(elems.username.parentNode, 'Укажите имя пользователя.');
               }
      
                resetError(elems.email.parentNode);
      
               if (!elems.email.value) {
             	r = false;
               showError(elems.email.parentNode, 'Укажите email.');
               } 
      	
               resetError(elems.textarea.parentNode);
      
               if (!elems.textarea.value) {
             	r = false;
               showError(elems.textarea.parentNode, 'Введите текст задачи.');
               } 
        
        
               resetError(elems.picture.parentNode);
      
               if (!elems.picture.files[0]) {
             	r = false;
               showError(elems.picture.parentNode, 'Выберете картинку.');
               } 
               
               
            if (r){
			 	
		
             sendForm(task_form,"./uploadTask.php",function(data)
                      {
             	
                       var strArray = data.split('|');
            
            
                       if (strArray){
				
			           var flag = 	strArray[0].replace(/\s/g, '');
		
        	           if (flag == 'ok')
        	           {
        	           	
        	           	var form_preview = {};
        	           	
        	            form_preview.username = decodeURIComponent(strArray[1]);
        	            form_preview.email =   strArray[2];
        	            form_preview.textarea = decodeURIComponent(strArray[3]);	
        	            form_preview.url_pic = strArray[4];	
        	           
        	          	showFormSaveTask(form_preview);
							
						}
				
				
				
				        
			          else 
			 
		 	          if (flag == 'error')
			            {
			
				
			             switch (strArray[1]) 
			              {
                            case 'max_size':
                            showError(elems.picture.parentNode, 'Размер файла превышает 1м.');
                            break;
                
                            case 'format_email':
                            showError(elems.email.parentNode, 'Неверно введен email.');
                            break;
                
                            case 'type_file':
                            showError(elems.picture.parentNode, 'Формат изображения не поддерживается.');
                            break;
                
                            case 'picture':
                            showError(elems.picture.parentNode, 'Ошибка изображения.');
                            break;
                
                          }
			
		                }
		             }
	                 
                 });
			 	
			  }  
               
         }
		
		



function showFormSaveTask(form)
   {
   	    go("block_preview").style.display = "block";
    	go("block_task_form").style.display = "none";	
    	go("preview_username").innerText = form.username;
		go("preview_email").innerText = form.email;
		go("preview_textarea").innerText = form.textarea;
		go("preview_picture").src = form.url_pic;
   }


function Back()
  {
  	
  go("block_preview").style.display = "none";
  go("block_task_form").style.display = "block";	
  	
  }
  
  
 </script>
 
</body>
</html>	
	
	