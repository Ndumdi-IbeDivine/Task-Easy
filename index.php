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
<div class="sidebar">
    <h4>TASK EASY</h4>
    <a href="#projects">To-do</a>
    <a href="#completed">In-progress</a>
    <a href="#trash">Finished-Tasks</a>

    <a href="<?php echo SITEURL; ?>manage-lists.php">Manage lists</a>
</div>
<!-- side bar ends here -->

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

    <tr>
        <td>1.</td>
        <td>Submit project assignment</td>
        <td>high</td>
        <td>26/10/2023</td>
        <td>
            <a href="#">Update</a>

            <a href="#">Delete</a>

        </td>
    </tr>
    </table>
</div>
<!-- page content ends here -->
  
</body>
</html>