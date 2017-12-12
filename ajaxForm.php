<html> 
<head> 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="http://malsup.github.com/jquery.form.js"></script> 
 
    <script> 
        // wait for the DOM to be loaded 
        $(document).ready(function() { 
            // bind 'myForm' and provide a simple callback function 
            var options = { 
                    target:        '#output1',   
                    beforeSubmit:  showRequest,  
                    success:       showResponse ,
                    clearForm: true
            }
            $('#myForm').ajaxForm(options);
             
            
        }); 
        function showRequest(formData, jqForm, options) { 
			var queryString = $.param(formData); 
			alert('About to submit: \n\n' + queryString); 
			return true; 
		}
		function showResponse(responseText, statusText, xhr, $form)  { 
			alert('status: ' + statusText + '\n\nresponseText: \n' + responseText +'\n\nThe output div should have already been updated with the responseText.'); 
		}
    </script> 
</head> 
<body>
	<form id="myForm" action="ajaxSubmit.php" enctype="multipart/form-data" method="post"> 
		Name: <input type="text" name="name" /> 
		file <input type="file" name="prof_pic">
		Comment: <textarea name="comment"></textarea> 
		<input type="submit" value="Submit Comment" /> 
	</form>
	<div id="output1"></div>
</body>
</html>
