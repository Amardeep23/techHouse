<?php

include('db_connect.php');
$errorMessage = $username = $password = $account_type = '';
$error = ['username'=>'', 'password'=>'', 'account_type'=>''];

if(isset($_POST['submit'])){

    //check username
    if(empty($_POST['username'])){
        $error['username'] = "username is required <br />";
    }else{
        $username = $_POST['username'];
       
    }
    

   //check password
   if(empty($_POST['password'])){
        $error['password'] = "password is required <br />";
    }else{
        $password = $_POST['password'];

    }

    //check account_type
    if(empty($_POST['account_type'])){
        $error['account_type'] = "Select one of the Buttons<br />";
    }else{
        $account_type = $_POST['account_type'];
    }

    //session 
    session_start();
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['account_type'] = $_POST['account_type'];

};

if(array_filter($error)){
    echo 'errors in the from';
}else{

    if(isset($_POST['username']) ||isset($_POST['password']) || isset($_POST['account_type'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $account_type = mysqli_real_escape_string($conn, $_POST['account_type']);

        $s = "SELECT * FROM user_info WHERE username = '$username' && password = '$password' && account_type = '$account_type'";
        $result = mysqli_query($conn, $s);

        $num = mysqli_num_rows($result);

        if($num == 1){
            header('Location: homepage.php');
        }else{
         $errorMessage = 'Username or Password did not matched the database.';
        }
    }

};

//check end



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index page</title>

    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="outerDiv">
        <div class="heading">
            <h2>Tech House</h2>
        </div>

        <div class="form">
            <form action="index.php" method="POST">
                <label>Username</label>
                <input type="text" name="username" class="inputfield" value="<?php echo htmlspecialchars($username) ?>">
                <div class="red-text"><?php echo $error['username']?></div>

                <label>Password</label>
                <input type="password" name="password" class="inputfield" value="<?php echo htmlspecialchars($password) ?>">
                <div class="red-text"><?php echo $error['password'] ?></div>

                <label>Type of Account</label>
                <input type="radio" name="account_type" value="admin" required> Admin
                <input type="radio" name="account_type" value="user" required> User

                <div class="button">
                    <input type="submit" name="submit" value="submit" id="btn" style="color:black; background-color: lightblue; width:70px; height:40px; font-size: 1.12rem; border-radius: 10px;">
                </div>
                <p>New User? <a href="signup.php" class="signUpAnchor">SIGN UP HERE</a></p>
                <div>
                    <p><?php echo $errorMessage ?></p>
                </div>
            </form>
        </div>
    </div>    
</body>
</html>