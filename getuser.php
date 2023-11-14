<!DOCTYPE html> 
<html> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise05-Search</title>
    <style> 
        table { 
            width: 100%; 
            border-collapse: collapse; 
        } 
        
        table, td, th { 
            border: 1px solid white; 
            padding: 5px; 
        } 
        
        th {
            text-align: left;
        } 
    </style> 
</head> 
<body> 
    <h1>Employee Details</h1> 
    <?php 
        $id = $_GET['empid']; 
        
        $con = mysqli_connect('localhost','root','','mydb'); 
        if (!$con) 
        { 
            die('Could not connect!!'); 
        } 
        $sql="SELECT * FROM employee WHERE id= '".$id."'";
        $result = mysqli_query($con,$sql); 
        echo "<table> 
        <tr> 
            <th>Name</th> 
            <th>Address</th> 
            <th>Phone</th> 
            <th>Salary</th>
        </tr>"; 

        while($row = mysqli_fetch_array($result))
         { 
            echo "<tr>"; 
            echo "<td>" . $row['name'] . "</td>"; 
            echo "<td>" . $row['address'] . "</td>"; 
            echo "<td>" . $row['phone'] . "</td>"; 
            echo "<td>" . $row['salary'] . "</td>";
            echo "</tr>"; 
        } 
        echo "</table>"; 
        mysqli_close($con); 
    ?> 
</body> 
</html>
