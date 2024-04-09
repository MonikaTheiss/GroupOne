<?php
if(isset($_COOKIE["Manager"]) && $_COOKIE["Manager"] !="")
{
    setcookie("Manager","",time()-3600,"/");

}
if(isset($_COOKIE["user_id"])&& $_COOKIE["Status"] ==="Logged-in")
{
    setcookie("Status","",time()-3600,"/");
    setcookie("user_id","",time()-3600,"/");

    unset($_COOKIE);

    echo "<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Logged out</title>
    <style>
        body {
            font-family: 'Helvetica'; 
            color: rgb(125, 125, 125); 
        }

        div {
            display: flex;
            flex-direction: column;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.25);
            height: fit-content;
            width: 350px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        h1 {
            color: rgb(74, 74, 74);
            margin: 0px;
        }

        span {
            padding: 15px;
            background-color: #737373;
        }

        a {
            margin-top: 20px;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div>
        <h1>Logged out</h1>
        <p>You have succesfully logged out of your account.  Click the button below to redirect back to the home page.</p>

        <a href=\"../frontend/home.php\">
            <span>
                Redirect to home or wait five seconds...
            </span>
        </a>
    </div>
    <script>setTimeout(function(){window.location.assign('../frontend/home.php');},5000);</script>
</body>";
    
} 
else
{
    // user not logged in 
    //if the user is not logged in, the header should be changed so no logged out link is in the header! Shannon's work
}



//can someone make a logging out thingy?
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged out</title>
    <style>
        body {
            font-family: 'Helvetica'; 
            color: rgb(125, 125, 125); 
        }

        div {
            display: flex;
            flex-direction: column;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.25);
            height: fit-content;
            width: 350px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        h1 {
            color: rgb(74, 74, 74);
            margin: 0px;
        }

        span {
            padding: 15px;
            background-color: #737373;
        }

        a {
            margin-top: 20px;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div>
        <h1>Logged out</h1>
        <p>You have succesfully logged out of your account.  Click the button below to redirect back to the home page.</p>

        <a href="../frontend/home.html">
            <span>
                Redirect to home
            </span>
        </a>
    </div>
</body>
</html> -->

