<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MemeIT</title>

    <link rel="stylesheet" href=<?php echo ROOT."views/css/style.css"?>>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

    <style>
        main {
            padding: 30px;
        }

        .btn {
            background-color: #4056A1;
        }
    </style>
</head>

<body>
    <?php require_once VIEWS_DIR."/header.php"; ?>

    <main style="background-image: url('<?php echo ROOT."views/images/memes.jpg" ?>')">
        <h1>Welcome to MemeIT!</h1>
        <a class="btn" href="<?php echo ROOT."generator" ?>"><i class="fa fa-rocket"></i> Let's make a meme</a>
    </main>

    <?php require_once VIEWS_DIR."/footer.php"; ?>

    <!-- <script src=<?php echo ROOT."views/js/script.js"?>></script> -->

</body>

</html>