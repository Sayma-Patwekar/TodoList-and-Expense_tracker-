<?php
  $error="";

  $conn=mysqli_connect('localhost','root','','Todos');

  if(isset($_POST['submit'])){
    $task = $_POST['task'];
    if(empty($task))
    {
      $error="You must fill in the task";
    }else{
    $sql="INSERT INTO tasks(task) VALUES ('$task') ";
    mysqli_query($conn,$sql);
    header('loaction: index.php');
  }
}

  if(isset($_GET['del_task'])){
    $id=$_GET['del_task'];
    mysqli_query($conn,"DELETE FROM tasks WHERE id='$id'");
    header('location:index.php');
  }

  $tasks = mysqli_query($conn,"SELECT * FROM tasks");
?>


<html>
  <head>
    <title>TODO LIST APPLICATION</title>
    <link rel="stylesheet" type="text/css" href="todo.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  </head>

  <body>
    <div class="heading">
      <h2>REMEMBER YOUR TASKS!!</h2>
    </div>

    <form method="POST" action="index.php">
      <?php if(isset($error)){?>
        <p><?php echo $error;?><p>
      <?php }?>
      <input type="text" name="task" class="task_input" placeholder="Enter your task">
      <button type="submit" class="task_btn" name="submit">Add Task</button>
    </form>

    <table>
      <thead>
        <tr>
          <th>SR.NO</th>
          <th>TASK</th>
          <th>ACTION</th>
        </tr>
      </thead>

      <tbody>
        <?php $i=1; while($row=mysqli_fetch_assoc($tasks)){ ?>
          <tr>
          <td><?php echo $i;?></td>
            <td>

                  <input type="checkbox" id="myCheck" class="strikethrough">

                  <label class="strikeThis">
                    <?php echo $row['task'];?>
                  </label>
                
        </td>
                
            <td class="delete">
              <a href="index.php?del_task=<?php echo$row['id']; ?>"><i style='font-size:20px' class='fas'>&#xf2ed;</i></a>
            </td>
          </tr>
        <?php $i++;}?>

      </tbody>

    </table>
  </body>
</html>
