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

    <h3>Manage List Page</h3>

    <p>
        
        <?php 
        
            //Session successful message
            if(isset($_SESSION["add"]))
            {
                //display session message
                echo $_SESSION["add"];
                //Remove the message after displaying once
                unset($_SESSION["add"]);
            }

            //Check the session for delete success    
            if(isset($_SESSION["delete"]))
            {
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
            }

            //Check Session Message for Update
            if(isset($_SESSION["update"]))
            {
                echo $_SESSION["update"];
                unset($_SESSION["update"]);
            }

            //Check for delete Fail
            if(isset($_SESSION["delete_fail"]))
            {
                echo $_SESSION["delete_fail"];
                unset($_SESSION["delete_fail"]);
            }
        
        ?>
        
    </p>
    
<!-- table to display tasks starts here -->
    <div class="all-lists">

        <a class="btn-primary" href="<?php echo SITEURL; ?>add-list.php">Add List</a>

        <table>
            <tr>
                <th>S.N.</th>
                <th>List Name</th>
                <th>Actions</th>
            </tr>

            <?php
            
            // connect database
            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

            // select database
            $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

            //SQl Query to display all data from database
            $sql = "SELECT * FROM tbl_lists";
                    
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            
            //Check whether the query executed executed successfully or not
            if($res==true)
            {
                //Count the rows of data in database
                $count_rows = mysqli_num_rows($res);

                //Create a serial number variable
                $sn = 1;

                // Check if there's data in database
                if ($count_rows>0)
                {
                    // code to display data

                    // to loop through database
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Getting the data from database
                        $list_id = $row["list_id"];
                        $list_name = $row["list_name"];
                        ?>
                        
                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $list_name; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>update-list.php?list_id=<?php echo $list_id; ?>">Update</a> 
                                <a href="<?php echo SITEURL; ?>delete-list.php?list_id=<?php echo $list_id; ?>">Delete</a>
                            </td>
                        </tr>
                        
                        <?php
                        
                    }


                }else {
                    // In the case of no data in database
                    ?>

                    <tr>
                        <td colspan="3">No List Added Yet.</td>
                    </tr>

                    <?php
                }
                
            }

            ?>
            

        </table>
    </div>
<!-- table to display tasks ends here -->

</body>
</html>