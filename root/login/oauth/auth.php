<?php
    /*Starts a session (think cookies) in your browser so we can store data for other parts of the web page*/

session_start();


    /*Fetches the special code received from Discord*/

$q=base64_decode($_GET["q"]);
preg_match('/access_token=([^&]*)/', $q, $matches);

    /*This is how we choose what information we want to return. Below is some documentation regarding just one of the many
    ways to request data from discord.
    https://discordapp.com/developers/docs/resources/user#get-current-user-guilds

    Here we are using api/users/@me/guilds, which is requesting all guild information that the user is in.*/

$url = 'https://discordapp.com/api/users/@me/guilds';
$code = $matches[1];

    /*There are two types of headers we can use. A user header, and a bot header.
    Using a user header will allow you to collect detailed information about the user such as email, the servers they are in,
    when their account was created, etc

    Using a bot header will allow you to access information that the bot itself sees such as, every server, channel, or user it
    sees, any bans or logs per server.

    The header seen below is a user header. I will show an example of a bot header later in this page.*/

$options = array(
    'http' => array(
        'header'  => "Authorization: Bearer ".$code. "\nUser-Agent: {USER AGENT HERE} ({SITE URL HERE}, 1.0)",
        'method'  => 'GET'
    )
);
$context  = stream_context_create($options);

    /*$result is the raw array data from our discord api request. It contains all the information regarding our users guilds. */

$result = file_get_contents($url, false, $context);

    /*json_decode will take our $result, aka the raw array data, and convert it into a nicer looking array.
    We then can search for individual segments of information, say the id of the user, and then store it in a variable.
    So for example, $user_name is stored with the findings that json_decode finds when searching for username in the array */

$user_id = json_decode($result,true)["id"];
$user_name = json_decode($result,true)["username"];
$user_avatar = json_decode($result,true)["avatar"];

    /*To actually use this information outside of this page, we need to store it in cookie form for later use.
    To do that we use the code below. We need to store each variable from about in its own labeled cookie.*/

$_SESSION['user_id'] = $user_id;
$_SESSION['user_name'] = $user_name;
$_SESSION['user_avatar'] = $user_avatar;

?>


<?php

    /*Here we will make another request to the discord api, but this time we will look for strictly
    You can find more about the url you will need here https://discordapp.com/developers/docs/resources/guild#get-guild-roles

    For this example I use the Apsire servers ID in the url. You may only use the IDs of servers your bot has permission for.*/

$url = 'https://discordapp.com/api/guilds/326458315389272065/bans';
$code = $matches[1];

/*Here we see an example of the bot header we mentioned earlier. You must use your bots Auth token. You can get it from here https://discordapp.com/developers/applications/me/ */
$options = array(
    'http' => array(
        'header'  => "Authorization: Bot MTk4NjIyNDgzNDcxOTI1MjQ4.Cl2FMQ.ZnCjm1XVW7vRze4b7Cq4se7kKWs". "\nUser-Agent: {USER AGENT HERE} ({SITE URL HERE}, 1.0)",
        'method'  => 'GET'
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

$json = json_decode($result,true);

    /*In most cases, you will want to debug this page for any mistakes or just to figure out what data to collect. To do that
    You can use echo "<pre>"; and echo "</pre>"; as shown below. In between these two you can print_r any variable you want and it will
    show up in the page when you try to login. Note that you will not be able to see any debug text if you do not comment out the header("Location: /"); line as talked about below.

    This entire php block results in this in your browser https://i.gyazo.com/f99889063bcbda8917d8103a637f7a57.png*/

echo "<pre>";
    print_r($json);
    print_r("\n");
echo "</pre>";

?>



<?php

    /*Once all of the above code has been completed, the code below will redirect the user back to the home page of the website.
    Comment this out if you would wish to debug and not get redirected.*/

header("Location: /");
?>