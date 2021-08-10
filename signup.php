<?php
    include('db_connect.php');

    $tan = $name = $username = $password = $account_type = '';
    $error = ['name'=>'', 'username'=>'', 'password'=>'', 'account_type'=>''];

    if(isset($_POST['submit'])){
        
         //check name
        if(empty($_POST['name'])){
             $error['name'] = "name is required <br />";
        }else{
             $name = $_POST['name'];
             if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
                $error['name']  =  'Name must be letters and spaces only';
            }
        }

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
    };

    if(array_filter($error)){
        echo 'errors in the from';
    }else{
        if(isset( $_POST['name']) || isset( $_POST['username'])|| isset($_POST['password']) || isset($_POST['account_type'])){
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $account_type = mysqli_real_escape_string($conn, $_POST['account_type']);

            $s = "SELECT * FROM user_info WHERE username = '$username'";
            $result = mysqli_query($conn, $s);

            $num = mysqli_num_rows($result);

            if(!$num == 1){
                
                //create sql
                $sql = "INSERT INTO user_info(name,username,password,account_type) VALUES('$name', '$username', '$password', '$account_type')";

                //save to db and check
                if(mysqli_query($conn, $sql)){
                //a success
                header('Location: index.php');
                }else{
                    //error
                    echo 'query error' . mysqli_error($conn);
                }
            }else{
                $tan = 'Username already taken';
                
            }
        }
    
    };

    //check end


?>

<html lang="en" class="html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="outerDiv">
        <div class="heading">
            <h2>Tech House</h2>
        </div>

        <div class="form">
            <form action="signup.php" method="POST">
                <label>Name</label>
                <input type="text" name="name" class="inputfield" value="<?php echo htmlspecialchars($name) ?>">
                <div calss="red-text"><?php echo $error['name']?></div>

                <label>Username</label>
                <input type="text" name="username" class="inputfield" value="<?php echo htmlspecialchars($username) ?>">
                <div class="red-text"><?php echo $error['username'] ?></div>
                <div class="red-text"><?php echo $tan; ?></div>

                <label>Password</label>
                <input type="password" name="password" class="inputfield" value="<?php echo htmlspecialchars($password) ?>">
                <div class="red-text"><?php echo $error['password'] ?></div>

                <label>Type of Account</label>
                <input type="radio" name="account_type" value="admin" required> Admin
                <input type="radio" name="account_type" value="user" required> User

                <div class="button">
                    <input type="submit" name="submit" value="submit" id="btn" style="color:black; background-color: lightblue; width:70px; height:40px; font-size: 1.12rem; border-radius: 10px;">
                </div>
            </form>
        </div>
    </div>    

</body>
</html>