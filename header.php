<?php
    //session 
    session_start();

    $username = $account_type = '';
    if(isset($_SESSION['username'])||isset($_SESSION['account_type'])){
        $username = $_SESSION['username'];
        $account_type = $_SESSION['account_type'];
    }


    // end session
    if(isset($_POST['logout'])){
        session_unset();
        header('Location: index.php');
    }

?>


<head>
    <title>Tech House</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
        .brand{
            background: #cbb09c !important;
        }
        .brand-text{
            color: #cbb09c !important;
        }
        form{
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }
        @media only screen and (max-width: 1000px){
            .brand-logo{
                position: absolute!important;
                left: 25%!important;
            }
        }
        @media only screen and (max-width: 500px){
            .brand-logo{
                position: absolute!important;
                left: 20%!important;
            }
        }
    </style>
</head>

<body class="grey lighten-4">

    <nav class="white z-depth-0">
        <div class="container">
            <!-- add a link here later -->
            <a href="homepage.php" class="brand-logo brand-text">Tech House</a>
            <ul id="nav-mobile" class="right">
                <li><a href="add.php" class="btn brand z-depth-0">Add a SMART PHONE</a></li>
                <form action="header.php" method="POST">
                    <input type="submit" name="logout" value="logout" class="btn brand z-depth-0">
                </form>
                </li>
                <li class="grey-text" class="welcomeMessage">Welcome  <?php echo htmlspecialchars($username) ?></li>
                <li  class="grey-text" class="welcomeMessage">(<?php echo htmlspecialchars($account_type) ?>)</li>
            </ul>
        </div>
    </nav>
    
   