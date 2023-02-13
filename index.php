<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Events Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" id="homepage">
        <h1 class="app-title">School Event Management System</h1>
        <div>
            <form class="login" action="login.php" method="POST">
                <?php if(isset($_GET['error'])){ ?>
                    <p class="error">
                        <?php echo $_GET['error'];?>
                    </p>
                <?php }?>
                <div><input type="text" placeholder="Username" name="uname"></div>
                <div><input type="password" placeholder="Password" name="password"></div>
                <div><a href="forgot-password.html" >Forgot Passsword?</a></div>
                <div><button type="submit" class="btn_login">Login</button></div>
                
            </form>
        </div>
    </div>
</body>
</html>