<?php 
    include("config/constants.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Easy Task-manager</title>
</head>
<body>
    
    <button><a href="<?php echo SITEURL; ?>">Home</a></button>

    <h3>ADD LISTS PAGE</h3>

    <p>
        
        <?php 
        
            //Session failed message
            if(isset($_SESSION["add_fail"]))
            {
                //display session message
                echo $_SESSION["add_fail"];
                //Remove the message after displaying once
                unset($_SESSION["add_fail"]);
            }
        
        ?>
        
    </p>

    <form method="POST" action="">

        <table>
            <tr>
                <td>List Name</td>
                <td><input type="text" name="list_name" placeholder="Type list name here" required="required"></td>
            </tr>
            <tr>
                <td>List Description</td>
                <td><textarea name="list_description" placeholder="Type list description here"></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="SAVE"></td>
            </tr>
        </table>

    </form>

    <div>
        <button><a href="<?php echo SITEURL; ?>manage-lists.php">Manage Lists</a></button>
    </div>
</body>
</html>

<?php

// check the form is submitted or not
if(isset($_POST["submit"]))
{
    // get the values from form and save it as variables
    $list_name = $_POST["list_name"];
    $list_description = $_POST["list_description"];

    // connect to database 
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    //  check if database connection is successful
    if($conn==true)
    {
        // echo "database connected ";
    }
    // select database to use
    $db_select = mysqli_select_db($conn, DB_NAME);
    // check if database is connected or not
    if($db_select==true)
    {
        // echo "database selected";
    }

    //SQL Query to Insert data into database
    $sql = "INSERT INTO tbl_lists SET
        list_name = '$list_name',
        list_description = '$list_description'
    ";

    //Execute Query and Insert into Database
    $res = mysqli_query($conn, $sql);
        
    //Check whether the query executed successfully or not
    if($res==true)
    {
        //Create a Session variable to Display message
        $_SESSION["add"] = "List Added Successfully";
        //Redirect to Manage List Page
        header("location:".SITEURL."manage-lists.php");
    }
    else
    {
        //Create Session to save message
        $_SESSION["add_fail"] = "Failed to Add List";
        //Redirect to Same Page
        header("location:".SITEURL."add-list.php");
    }

}




?>