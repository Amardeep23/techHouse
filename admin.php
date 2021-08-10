<?php 
    include('db_connect.php');
    error_reporting(0);

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM smartphone WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            //sucess
            header('Location: homepage.php');
        }else{
            //failure
            echo 'query error' . mysqli_error($conn);
        }

    } 

    //CHECK GET REQUEST id param
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //make sql
        $sql = "SELECT * FROM smartphone WHERE id = $id";

        //get the query results
        $result = mysqli_query($conn, $sql);

        //fetch results in an array format 
        $smartphone = mysqli_fetch_assoc($result) ?? '';  

        //free results
        mysqli_free_result($result);

        //end connection
        mysqli_close($conn);
        // print_r($smartphone);
    }

?>

<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>

    <div class="container center">
        <?php  if($smartphone): ?>
            <h4><?php echo htmlspecialchars($smartphone['title']); ?> </h4>
            <p>Created by: <?php echo htmlspecialchars($smartphone['email']); ?></p>
            <p><?php echo date($smartphone['created_at']); ?></p>
            <h5>Features</h5>
            <ul>
                <?php foreach(explode(',', $smartphone['features']) as $ing){ ?>
                <li><?php echo htmlspecialchars($ing); ?></li>
                <?php } ?>    
            </ul>

            <!-- Delete Form -->
            <form action= "admin.php" method="POST">
                <input type="hidden" name="id_to_delete" value= "<?php echo $smartphone['id'] ?>">
                <input type="submit" name= "delete" value= "Delete" class= "btn brand z-depth-0">       
            </form>        

        <?php else: ?>
            <h5>No such smartphone exist</h5>
        <?php endif ?>
    </div>

    <?php include('footer.php'); ?>
</html>