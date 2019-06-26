<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MemeIT - Meme Generator</title>

    <link rel="stylesheet" href=<?php echo ROOT."views/css/style.css"?>>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

</head>

<body>
    <?php require_once VIEWS_DIR."/header.php"; ?>

    <main id="memes" style="background-image: url('<?php echo ROOT."views/images/papyrus.png" ?>'); background-size: auto;">
    </main>

    <?php require_once VIEWS_DIR."/footer.php"; ?>
    <script src=<?php echo ROOT."views/js/collection.js"?>></script>
</body>

</html>