<?php
$error="";
$con=mysqli_connect("localhost","root","","todo") or die(mysqli_error($con));
if(isset($_POST['submit'])){
    $task=$_POST['task'];
    if(empty($task)){
        $error="You must fill the task first";
    }
   else{ 
 $task_query = "INSERT into tasks (task) values ('$task')";
 $task_submit = mysqli_query($con, $task_query) or die(mysqli_error($con));
  header('location:todo.php');
 }
 
}

if(isset($_GET['del_task'])){
    $id=$_GET['del_task'];
     $task_query = "DELETE FROM  tasks WHERE id=$id";
     $task_submit = mysqli_query($con, $task_query) or die(mysqli_error($con));
       header('location:todo.php');
}

?>




<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >


        <!--jQuery library--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


        <!--Latest compiled and minified JavaScript--> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
	
	 <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TODO LIST</title>
    
    <link href="to.css" rel="stylesheet" type="text/css"> 
    
    
    
    </head>
    <body>
        <div class="heading"><h4>TODO LIST</h4></div>
        
        <div>
            <form method="POST" action="todo.php">
                <?php if(isset($error)){
                echo "<p>".$error."</p>";
                
                }?>
                <input type="text" name="task" class="task" placeholder="Enter your task here">
                <button type="submit" class="btn-success" name="submit">ADD</button>
            </form>
              
            <table>
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Task</th>
                        <th>Action</th>
                    </tr>
                </thead>
                  <tbody>
                      <?php 
                       $sql = "SELECT * FROM tasks";
                       $result = $con->query($sql);
                       $i=1;
                    while($user = $result->fetch_assoc()){ ?>
                      <tr>
                          <td> <?php echo $i; ?> </td>
                    <td class=item<?php echo $user['done']?'done':'';?>><?php echo $user['task'];?></td>
                      
                      <td class=delete><a href="todo.php?del_task=<?php echo $user['id']; ?>">x</a></td>
                      <?php if(!$user['done']): ?>
                      <td class="donex"> <a href="mark.php?as=done&item=<?php echo $user['id'];?>" >Mark as Done</a></td></tr>
                      <?php endif ;?>
                      
                      
                    <?php $i++; }  ?>
                    
                     
                </tbody>
                
                
                
            </table>
            
            
        </div>

        
    </body>
</html>



