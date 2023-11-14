<!DOCTYPE html> 
<html> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise05-Search</title>
    <script> 
    function showUser(str) 
    { 
        if (str == "") 
        { 
            document.getElementById("txtHint").innerHTML = "No Employee Records"; 
            return; 
        } 
        else 
        {  
            if (window.XMLHttpRequest) { 
                // code for IE7+, Firefox, Chrome, Opera, Safari 
                xmlhttp = new XMLHttpRequest(); 
            } 
            else 
            { 
                // code for IE6, IE5 
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
            } 
            xmlhttp.onreadystatechange = function() { 
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                { 
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText; 
                } 
            }; 
            xmlhttp.open("GET","getuser.php?empid="+str,true); 
            xmlhttp.send(); 
        } 
    } 
    </script> 
    <style>
        body{
            background: black;
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
            font-weight: bolder;
            font-size: larger;
        }
        select{
            padding: 5px;
            border: 1px solid yellow;
            font-size: large;
        }
    </style>
</head> 
<body> 
    <h1 style="text-align:center">ABC Technology</h1>
    <form>
        <label>Select Employee: &nbsp;</label>
        <select name="users" onchange="showUser(this.value)"> 
            <option value="">--Select--</option> 
            <option value="1">Employee-1</option> 
            <option value="2">Employee-2</option> 
            <option value="3">Employee-3</option> 
        </select> 
    </form> 
    <br> 
    <div id="txtHint" style="text-align:center"><b>Employee information will display here..</b></div> 
</body> 
</html> 
