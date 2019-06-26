<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MemeIT - Registration</title>

    <link rel="stylesheet" href=<?php echo ROOT."views/css/style.css"?>>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
</head>

<body style="background-image: url('<?php echo ROOT."views/images/background.jpg" ?>')">
    <main>
        <div id="wrapper">
        <div id="register" class="animate form">
			<form name="register" method="POST" action="<?php echo LOCATION.'register'?>" autocomplete="on"> 
                <h1>Register</h1> 
                <div class="row">
                    <div class="column">
                        <p> 
                            <label for="name" class="uname">Name</label>
                            <input id="name" name="name" required="required" type="text" placeholder="Enter your name..." />
                        </p>
                        <p> 
                            <label for="fn" class="ufn">Faculty Number</label>
                            <input id="fn" name="fn" required="required" type="number" placeholder="Enter your faculty number..." />
                        </p>
                        <p> 
                            <label for="topic" class="utopic">Topic</label>
                            <!-- <input id="topic" name="topic" required="required" type="text" placeholder="Enter your topic..." /> -->
                            <select id="topic_id" name="topic_id" required>
                                <option value="" disabled selected hidden>Select your topic...</option>
                                <option value='1'>1 - Google - Web Performance Best Practices</option>
                                <option value='2'>2 - HTML5 - част 1 семантични тагове. Примери.</option>
                                <option value='3'>3 - HTML5 - част 2 форми. Примери.</option>
                                <option value='4'>4 - CSS: стилове, класове, селектори</option>
                                <option value='5'>5 - CSS: layouts, box model</option>
                                <option value='6'>6 - CSS: layouts, flexbox</option>
                                <option value='7'>7 - Анимации с CSS с използване на трансформации</option>
                                <option value='8'>8 - JavaScript - част 1</option>
                                <option value='9'>9 - DOM дърво, обхождане и манипулация</option>
                                <option value='10'>10 - Работа със сесии и cookies (от страна насървъра и клиента)</option>
                            </select>
                        </p>
                    </div>

                    <div class="column">
                        <p> 
                            <label for="email" class="youmail">Email</label>
                            <input id="email" name="email" required="required" type="email" placeholder="Enter your email..."/> 
                        </p>
                        <p> 
                            <label for="password" class="youpasswd">Password</label>
                            <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO"/>
                        </p>
                        <p> 
                            <label for="password_confirm" class="youpasswd">Confirm your password </label>
                            <input id="password_confirm" name="password_confirm" required="required" type="password" placeholder="Repeat password..."/>
                        </p>
                    </div>
                </div>


				<p class="signin button"> 
					<input type="submit" value="Sign up" name="registration" /> 
                </p>
                
                <?php include_once VIEWS_DIR.'/errors.php'; ?>

				<p class="change_link">  
					<span>Already have an account?</span>
					<a href=<?php echo ROOT ?> class="to_register">Log in</a>
				</p>
			</form>
		</div>
        </div>
    </main>

</body>

</html>