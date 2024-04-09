<!DOCTYPE html>
        <html>
            <head>
                <title>Cellar Secrets - Home Page</title>
                <meta charset="UTF-8" />
                <meta name="author" content="Shannon Venter u21451070" />
                <link href="css/homeStyle.css" type="text/css" rel="stylesheet" >
                <!-- <link rel="icon" href="img/favicon_io/favicon.ico" type="image/x-icon" > -->
            </head>
            <body>
                <div class="container">
                    <header>
                        <img id="mylogo" src="images/Logo.png"
                            alt="Cellar Secrets Logo"
                            title="Cellar Secrets Logo"
                            style="height: 150px;"/>
                        
                        <div id="nav">
                            <nav id="flex-list">
                                <ul>
                                    <li class="nav-list"><a href="home.php">Home</a></li>
                                    <li class="nav-list"><a href="wines.php">Wines</a></li>
                                    <li class="nav-list dropdown">
                                        <a href="javascript:void(0)">Choose a destination</a>
                                        <div class="dropdown-content">
                                            <a href="#" onclick="filterDestination('South-Africa')">South Africa</a>
                                            <a href="#" onclick="filterDestination('America')">United States</a>
                                            <a href="#" onclick="filterDestination('France')">France</a>
                                            <a href="#" onclick="filterDestination('Australia')">Australia</a>
                                            <a href="#" onclick="filterDestination('Chile')">Chile</a>
                                            <a href="#" onclick="filterDestination('Italy')">Italy</a>
                                            <a href="#" onclick="filterDestination('Spain')">Spain</a>
                                            <a href="#" onclick="filterDestination('Switzerland')">Switzerland</a>
                                            <a href="#" onclick="filterDestination('Germany')">Germany</a>
                                            <a href="#" onclick="filterDestination('New Zealand')">New Zealand</a>
                                            <a href="#" onclick="filterDestination('ww')">World Wide</a>
                                        </div>
                                    </li>
                                    <li class="nav-list" id="login1"><a id="login" href="login.html">Login</a></li>
                                    <li class="nav-list" id="signup1"><a id="signup" href="signup.html">Sign Up</a></li>
                                    <li class="nav-list" id="logout1"><a id="logout" href="../backend/logout.php">Log Out</a></li>
                                </ul>
                            </nav>
                        </div>
        
                    </header>
        
        
                    <div id="content">
                        <img id="loadingImg" src="images/loading.gif" alt="loading gif">
                    </div>
        
                    <section id="home-container">
                        
                        <div id="winery-container">
                            
                        
                        </div>
        
                        <!-- <div id="winery-container">
                            <div class="winery name destination">
        
                                <div class="img">
                                    <img id="winery2" src="images/boshendal1.jpg" alt="Winery Name">
                                </div>
        
                                <div class="info">
                                    <h2>Boschendal</h2>
                                    <p>Stellenbosch</p>
                                    <p><em>Founded 1685</em></p>
                                    <p><a href="https://boschendal.com/" target="_blank">website</a></p>
                                </div>
                            
                            </div>
                        
                        </div>
        
                        <div id="winery-container">
                            <div class="winery name destination">
        
                                <div class="img">
                                    <img id="winery3" src="images/boshendal1.jpg" alt="Winery Name">
                                </div>
        
                                <div class="info">
                                    <h2>Boschendal</h2>
                                    <p>Stellenbosch</p>
                                    <p><em>Founded 1685</em></p>
                                    <p><a href="https://boschendal.com/" target="_blank">website</a></p>
                                </div>
                            
                            </div>
                        
                        </div>
        
                        <div id="winery-container">
                            <div class="winery name destination">
        
                                <div class="img">
                                    <img id="winery4" src="images/boshendal1.jpg" alt="Winery Name">
                                </div>
        
                                <div class="info">
                                    <h2>Boschendal</h2>
                                    <p>Stellenbosch</p>
                                    <p><em>Founded 1685</em></p>
                                    <p><a href="https://boschendal.com/" target="_blank">website</a></p>
                                </div>
                            
                            </div>
                        
                        </div> -->
                    </section>
                            
                </div>  
            
            </body>

            <script src="js/home.js"></script>
        </html>
<?php
    /*
        echo '<!DOCTYPE html>
        <html>
            <head>
                <title>Cellar Secrets - Home Page</title>
                <meta charset="UTF-8" />
                <meta name="author" content="Shannon Venter u21451070" />
                <link href="css/homeStyle.css" type="text/css" rel="stylesheet" >
                <!-- <link rel="icon" href="img/favicon_io/favicon.ico" type="image/x-icon" > -->
            </head>
            <body>
                <div class="container">
                    <header>
                        <img id="mylogo" src="images/Logo.png"
                            alt="Cellar Secrets Logo"
                            title="Cellar Secrets Logo"
                            style="height: 150px;"/>
                        
                        <div id="nav">
                            <nav id="flex-list">
                                <ul>
                                    <li class="nav-list"><a href="home.php">Home</a></li>
                                    <li class="nav-list"><a href="wines.php">Wines</a></li>
                                    <li class="nav-list dropdown">
                                        <a href="javascript:void(0)">Choose a destination</a>
                                        <div class="dropdown-content">
                                            <a href="#" onclick="filterDestination('South-Africa')">South Africa</a>
                                            <a href="#" onclick="filterDestination('America')">United States</a>
                                            <a href="#" onclick="filterDestination('France')">France</a>
                                            <a href="#" onclick="filterDestination('Australia')">Australia</a>
                                            <a href="#" onclick="filterDestination('Chile')">Chile</a>
                                            <a href="#" onclick="filterDestination('Italy')">Italy</a>
                                            <a href="#" onclick="filterDestination('Spain')">Spain</a>
                                            <a href="#" onclick="filterDestination('Switzerland')">Switzerland</a>
                                            <a href="#" onclick="filterDestination('Germany')">Germany</a>
                                            <a href="#" onclick="filterDestination('New Zealand')">New Zealand</a>
                                            <a href="#" onclick="filterDestination('ww')">World Wide</a>
                                        </div>
                                    </li>
                                    <li class="nav-list" id="login1"><a id="login" href="login.html">Login</a></li>
                                    <li class="nav-list" id="signup1"><a id="signup" href="signup.html">Sign Up</a></li>
                                    <li class="nav-list" id="logout1"><a id="logout" href="../backend/logout.php">Log Out</a></li>
                                </ul>
                            </nav>
                        </div>
        
                    </header>
        
        
                    <div id="content">
                        <img id="loadingImg" src="images/loading.gif" alt="loading gif">
                    </div>
        
                    <section id="home-container">
                        
                        <div id="winery-container">
                            
                        
                        </div>
        
                        <!-- <div id="winery-container">
                            <div class="winery name destination">
        
                                <div class="img">
                                    <img id="winery2" src="images/boshendal1.jpg" alt="Winery Name">
                                </div>
        
                                <div class="info">
                                    <h2>Boschendal</h2>
                                    <p>Stellenbosch</p>
                                    <p><em>Founded 1685</em></p>
                                    <p><a href="https://boschendal.com/" target="_blank">website</a></p>
                                </div>
                            
                            </div>
                        
                        </div>
        
                        <div id="winery-container">
                            <div class="winery name destination">
        
                                <div class="img">
                                    <img id="winery3" src="images/boshendal1.jpg" alt="Winery Name">
                                </div>
        
                                <div class="info">
                                    <h2>Boschendal</h2>
                                    <p>Stellenbosch</p>
                                    <p><em>Founded 1685</em></p>
                                    <p><a href="https://boschendal.com/" target="_blank">website</a></p>
                                </div>
                            
                            </div>
                        
                        </div>
        
                        <div id="winery-container">
                            <div class="winery name destination">
        
                                <div class="img">
                                    <img id="winery4" src="images/boshendal1.jpg" alt="Winery Name">
                                </div>
        
                                <div class="info">
                                    <h2>Boschendal</h2>
                                    <p>Stellenbosch</p>
                                    <p><em>Founded 1685</em></p>
                                    <p><a href="https://boschendal.com/" target="_blank">website</a></p>
                                </div>
                            
                            </div>
                        
                        </div> -->
                    </section>
                            
                </div>  
            
            </body>

            <script src="js/home.js"></script>
        </html>';
        */
        if (isset($_COOKIE['Status']) && $_COOKIE['Status'] != "") { 
        ?>
                <script>
                    // document.getElementById('login').href = "login.html";
                    // document.getElementById('login').innerHTML = "Login";
                    document.getElementById("login").hidden = true;
                    //document.getElementById("login1").hidden = true;
                    // document.getElementById('signup').href = "signup.html";
                    // document.getElementById('signup').innerHTML = "Signup";
                    document.getElementById("signup").hidden = true;
                    //document.getElementById("signup1").hidden = true;
                </script>
            <?php 
            }
            else { 
                ?>
                <script>
                    // document.getElementById('logout').href = "../backend/logout.php";
                    // document.getElementById('logout').innerHTML = "Logout";
                    document.getElementById("logout").hidden = true; 
                    //document.getElementById("logout1").hidden = true; 
                </script>
            <?php
            }
        ?>

    


<?php
    include("footer.php");
?>
