<?php
    if(isset($_FILES['file']))
    {       
        $errors= array();       
        $file_name = $_FILES['file']['name'];  
        $file_size = $_FILES['file']['size'];  
        $file_tmp = $_FILES['file']['tmp_name'];   
        $file_type = $_FILES['file']['type']; 
    
        //The explode() function breaks a string into an array.   
        $temp=explode('.',$_FILES['file']['name']); 
          
        $file_ext=end($temp);          
        $expensions= array("pdf"); 
          
        if(in_array($file_ext,$expensions)=== false)
        {          
            $errors[]="extension not allowed, please choose a pdf File."; 
        }              
        if(empty($errors)==true) 
        {         
           move_uploaded_file($file_tmp,"Files/".$file_name);          
           echo "Succesfully Uploaded!!!!"; 
           echo "<ul> 
                    <li>Temp-Location: ".$file_tmp."
                      <li>Sent file: ".$file_name."     
                      <li>File size: ".$file_size."             
                      <li>File type:".$file_type."          
                  </ul>"; 
        }
        else
        {  
            print_r($errors);
        } 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise01-File Upload</title>
    <style>
        body{
            background: url(C:/xampp/htdocs/practice/download.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
            font-weight: bolder;
            font-size: larger;
        }
        input[type="submit"]{
            margin: 20px 0 0 120px;
            padding: 20px;
            background-color: black;
            color: white;
            border-radius: 10px;
            font-size: large;
            border: 1px solid white;
         }
         input[type="file"]{
            margin: 20px;
            padding: 20px;
            background-color: black;
            color: white;
            font-size: large;
            border-radius: 10px;
            border: 1px solid white;
         }
    </style>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <input type="file" name="file">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
</body>
</html>
