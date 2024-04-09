
<!-- <header>
    <style>
        #nav {
            width: 100%;
            height: 50px;
            background-color: #87A878;
            text-align: right;
        }

        .nav-list {
            display: inline-block;
            margin: 5px;
            padding-left: 20px;
            padding-right: 20px;
        }

        a:link {
            color: #243E36;
            text-decoration: none;
            font-size: 20px;
        }
            
        a:visited {
            color: #243E36;
        }
            
        a:hover {
            color: #fff;
        }

        /* Note: the following has to be applied to the body and not the .container class
            max-width: 1300px;
            margin-left: auto;
            margin-right: auto; */
            
    </style>
    
    <img id="mylogo" src="images/Logo.png"
        alt="Cellar Secrets Logo"
        title="Cellar Secrets Logo"
        style="height: 150px;"/>
    
    <div id="nav">
        <nav id="flex-list">
            <ul>
                <li class="nav-list"><a href="home.php">Home</a></li>
                <li class="nav-list"><a href="wines.php">Wines</a></li>
                <li class="nav-list" ><a id="login" href="login.html">Login</a></li>
                <li class="nav-list" ><a id="signup" href="signup.html">Sign Up</a></li>
                <li class="nav-list" ><a id="logout" href="../backend/logout.php">Log Out</a></li>
            </ul>
        </nav>
    </div> -->
    
    <?php

        echo'  <header>
        <style>
            #nav {
                width: 100%;
                height: 50px;
                background-color: #87A878;
                text-align: right;
            }
    
            .nav-list {
                display: inline-block;
                margin: 5px;
                padding-left: 20px;
                padding-right: 20px;
            }
    
            a:link {
                color: #243E36;
                text-decoration: none;
                font-size: 20px;
            }
                
            a:visited {
                color: #243E36;
            }
                
            a:hover {
                color: #fff;
            }
    
            /* Note: the following has to be applied to the body and not the .container class
                max-width: 1300px;
                margin-left: auto;
                margin-right: auto; */
                
        </style>
        
        <img id="mylogo" src="images/Logo.png"
            alt="Cellar Secrets Logo"
            title="Cellar Secrets Logo"
            style="height: 150px;"/>
        
        <div id="nav">
            <nav id="flex-list">
                <ul>
                    <li class="nav-list"><a href="home.php">Home</a></li>
                    <li class="nav-list"><a href="wines.php">Wines</a></li>
                    <li class="nav-list" ><a id="login" href="login.html">Login</a></li>
                    <li class="nav-list" ><a id="signup" href="signup.html">Sign Up</a></li>
                    <li class="nav-list" ><a id="logout" href="../backend/logout.php">Log Out</a></li>
                </ul>
            </nav>
        </div>  
        </header>';
        // echo "hi";
        // echo $_COOKIE["Status"];
        if (isset($_COOKIE['Status']) && $_COOKIE['Status'] != "") { 
    ?>
    
            <script>
                // document.getElementById('login').href = "login.html";
                // document.getElementById('login').innerHTML = "Login";
                document.getElementById("login").hidden = true;
                // document.getElementById('signup').href = "signup.html";
                // document.getElementById('signup').innerHTML = "Signup";
                document.getElementById("signup").hidden = true;
            </script>
            
        <?php 
        }
        else {
            ?>
            <script>
                // document.getElementById('logout').href = "../backend/logout.php";
                // document.getElementById('logout').innerHTML = "Logout";
                document.getElementById("logout").hidden = true; 
            </script>
        <?php
        }
    ?>

