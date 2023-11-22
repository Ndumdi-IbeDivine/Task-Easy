<?php 
    include("config/constants.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Easy Task-manager</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="home">
    
<!-- Sidebar -->
<div class="menu">
    <h4>TASK EASY</h4>

    <?php 
            
            //Comment Displaying Lists From Database in ourMenu
            $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
            
            //SELECT DATABASE
            $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
            
            //Query to Get the Lists from database
            $sql2 = "SELECT * FROM tbl_lists";
            
            //Execute Query
            $res2 = mysqli_query($conn2, $sql2);
            
            //CHeck whether the query executed or not
            if($res2==true)
            {
                //Display the lists in menu
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $list_id = $row2['list_id'];
                    $list_name = $row2['list_name'];
                    ?>
                    
                    <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                    
                    <?php
                    
                }
            }
            
        ?>

    <a href="<?php echo SITEURL; ?>manage-lists.php">Manage lists</a>
</div>
<!-- Menu ends here -->

<!-- page content starts here -->
<div class="all-tasks">

    <a class="btn-primary" href="<?php SITEURL; ?>add-task.php">Add Task</a>   
     
    <table>

    <tr>
        <th>S.N.</th>
        <th>Tasks Name</th>
        <th>Priority</th>
        <th>Deadline</th>
        <th>Actions</th>
    </tr>

    <?php 
            
                //Connect Database
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                
                //Select Database
                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                
                //Create SQL Query to Get DAta from Databse
                $sql = "SELECT * FROM tbl_tasks";
                
                //Execute Query
                $res = mysqli_query($conn, $sql);
                
                //CHeck whether the query execueted o rnot
                if($res==true)
                {
                    //DIsplay the Tasks from DAtabase
                    //Dount the Tasks on Database first
                    $count_rows = mysqli_num_rows($res);
                    
                    //Create Serial Number Variable
                    $sn=1;
                    
                    //Check whether there is task on database or not
                    if($count_rows>0)
                    {
                        //Data is in Database
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $task_id = $row['task_id'];
                            $task_name = $row['task_name'];
                            $priority = $row['priority'];
                            $deadline = $row['deadline'];
                            ?>
                            
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update </a>
                                    
                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                                
                                </td>
                            </tr>
                            
                            <?php
                        }
                    }
                    else
                    {
                        //No data in Database
                        ?>
                        
                        <tr>
                            <td colspan="5">No Task Added Yet.</td>
                        </tr>
                        
                        <?php
                    }
                }
            
            ?>

    </table>
</div>
<!-- page content ends here -->
  
</body>
</html>