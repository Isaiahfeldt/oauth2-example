<?php
session_start();

if( !empty($_SESSION['user_name']) ):
    $user_name = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];
    $user_avatar = $_SESSION['user_avatar'];
else:
endif;

?>

<!DOCTYPE html>
<head>
  <title>Title Here</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
<h1>

    <?php if( !empty($user_name) ): ?>
        <p>Hello <?= $user_name; ?>! </p>
        <p>Your User ID is: <?= $user_id; ?></p>
        <a href="logout.php">Click here to logout.</a>
        <br>
        <img src="https://cdn.discordapp.com/avatars/138148168360656896/<?= $user_avatar; ?>">
    <?php else: ?>
        <p>You are not logged in.</p>
        <a href="https://discordapp.com/oauth2/authorize?response_type=token&client_id=240950172396421121&scope=identify%20guilds&redirect_uri=http://bellbot.xyz/login/oauth/cb.html">Click here to login.</a>
    <?php endif; ?>
</h1>
</body
