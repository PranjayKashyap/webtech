<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise03-Session</title>
</head>
<body>
    <?php
        if(isset($_SESSION['views']))
        {
            $_SESSION['views']=$_SESSION['views']+1;
        }
        else
        {
            $_SESSION['views']=1;
        }
        echo "View Count=". $_SESSION['views'];
    ?>
</body>
</html>