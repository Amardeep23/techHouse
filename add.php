<?php

    include('db_connect.php');

    $email = $title = $features = '';
    $error = ['email'=>'', 'title'=>'','features'=>''];

    if(isset($_POST['submit'])){
       

        //check email
        if(empty($_POST['email'])){
            $error['email']  = "email is required <br />";        
        }else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error['email']  =  'email must be a valid email address';
            }
        };

        //check title
        if(empty($_POST['title'])){
            $error['title']  =  "title is required <br />";        
        }else{
            $title = $_POST['title'];
            // if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            //     $error['title']  =  'Title must be letters and spaces only';
            // }
        };

        //check features
        if(empty($_POST['features'])){
            $error['features']  =  "features is required <br />";        
        }else{
            $features = $_POST['features'];
            // if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $features)){
            //     $error['features']  =  'features must be comma separated list';
            // }
        };

        if(array_filter($error)){
            echo 'errors in the from';
        }else{
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $features = mysqli_real_escape_string($conn, $_POST['features']);

            //create sql
            $sql = "INSERT INTO smartphone(title,email,features) VALUES('$title', '$email', '$features')";

            //save to db and check
            if(mysqli_query($conn, $sql)){
                //a success
                header('Location: homepage.php');
            }else{
                //error
                echo 'query error' . mysqli_error($conn);
            }

        
        };

        //end of POST check 
    }

?>

<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>

    <section class="container grey-text">
        <h4 class="center">Add a Smart Phone</h4>
        <form action="add.php" class="white" method="POST">
            <label>Your Email</label>
            <input type="text" name="email" value = "<?php echo htmlspecialchars($email); ?>">
            <div class="red-text"><?php echo $error['email']; ?></div>
            <label>Smart Phone Name</label>
            <input type="text" name="title" value = "<?php echo htmlspecialchars($title); ?>">
            <div class="red-text"><?php echo $error['title']; ?></div>
            <label>Features(comma separated)</label>
            <input type="text" name="features" value = "<?php echo htmlspecialchars($features); ?>">
            <div class="red-text"><?php echo $error['features']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include('footer.php'); ?>

     
</html>