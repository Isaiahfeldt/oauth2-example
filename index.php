<?php
?>

<!DOCTYPE html>
    <head>
      <title>Title Here</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    </head>

    <body>
        <h1>
            <!--In this mock website, to login you must simply link your user to your oauth2 login page. You can create one yourself if you open up your bot in the My Apps section.
            It will look like this: https://i.gyazo.com/31d8985b95b61cf32a4b5614e922c683.png-->
            <a href="https://discordapp.com/oauth2/authorize?response_type=token&client_id=240950172396421121&scope=identify%20guilds&redirect_uri=http://bellbot.xyz/login/oauth/cb.html">Login</a>
            <!--To logout, simply include this somewhere on your website. Be sure to replace www.bellbot.xyz with your own website url. -->
            <a href="https://www.bellbot.xyz/oauth/logout.php">Logout</a>
        </h1>
    </body
</html>
