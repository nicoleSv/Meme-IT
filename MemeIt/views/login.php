<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MemeIT - Login</title>

    <link rel="stylesheet" href=<?php echo ROOT."views/css/style.css"?>>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
</head>

<body style="background-image: url('<?php echo ROOT."views/images/background.jpg" ?>')">
    <main>
        <div id="wrapper">
            <div id="login" class="animate form">
                <form  name="login" method="POST" action="<?php echo LOCATION.'login'?>" autocomplete="on"> 
                    <h1>Log in</h1> 
                    <p> 
                        <label for="email" class="uemail">Email</label>
                        <input id="email" name="email" required="required" type="email" placeholder="Enter your email..."/>
                    </p>
                    <p> 
                        <label for="password" class="youpasswd">Password</label>
                        <input id="password" name="password" required="required" type="password" placeholder="Enter your password..." /> 
                    </p>

                    <p class="login button"> 
                        <input type="submit" value="Login" name="login" /> 
                    </p>

                    <?php include_once VIEWS_DIR.'/errors.php'; ?>

                    <p class="change_link">
                        <span>Do not have an account?</span>
                        <a href=<?php echo ROOT."register" ?> class="to_register">Register</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

</body>

</html>