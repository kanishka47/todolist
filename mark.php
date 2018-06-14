<?php
 $con=mysqli_connect("localhost","root","","todo") or die(mysqli_error($con));
 
 if(isset($_GET['as'],$_GET['item']))
 {
     $as=$_GET['as'];
     $item=$_GET['item'];
     
     switch($as)
     {
         case 'done':
             $done_query = "UPDATE  tasks SET done='1' WHERE id=$item ";
            $done_submit = mysqli_query($con, $done_query) or die(mysqli_error($con));
            break;
     }
 }

    header('location:todo.php');
 
 
?>