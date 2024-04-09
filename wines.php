<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wines - Cellar Secrets</title>
    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="css/wines-style.css">
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <!-- Font awesome icons -->
    <script src="https://kit.fontawesome.com/3cafc5aa30.js" crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!-- Javascript file -->
    <!-- <script src="js/wines-script.js"></script> -->
    <!-- Styling that overrides default bootstrap styling -->
    <style>
        .card-title{
            color: #952525;
            font-family: 'Georgia';
        }
        .modal-title{
            color: #952525;
            font-family: 'Georgia';
        }

        body{
            font-family: Helvetica;
        }

        .card-footer, .modal-footer{
            background-color: white;
            border:none;
        }
        .modal-content{
            border: 5px solid #DBF9B8;
        }

        .card{
            border: 3px solid #87A878;
            overflow: hidden;
            box-shadow: 0 1rem 4rem rgba(0,0,0,0.1);
            cursor:pointer;
            transition: 0.5s;
        }

        .card:hover{
            transform: translateY(-0.5%);
            box-shadow: 0 2rem 4rem rgba(0, 0, 0, 0.361);
        }

        .btn{
            border-radius: 25px;
        }
    </style>
</head>
<body>
    <!-- Header after its converted to php -->
    <?php include_once 'header.php'; ?>
    <!-- Banner -->
    <div class="wine-body">
        <div class="body-text">
            <h1>Explore Our Enchanting <br/><span> Collection of Wines </span></h1>
        </div>
    </div>
    <br/>

    <!-- Filters section -->
    <div class="container filter-section">
        <h2>Browse Wines</h2>
        <p><i>Delve into a Global Wine Odyssey</i></p>
        
        <div class="filters">
            <div class="left">
                <input type="search" placeholder="Search for a wine" id="search-wine"/>
                <input class="search-button" onclick="searchWines()" type="button" value="Search" id="searchWine"></input>
            </div>
            <!-- Add wine button if manager -->
            <?php
                    if(isset($_COOKIE["user_id"])&& isset($_COOKIE["Manager"]) && $_COOKIE["Status"] ==="Logged-in")
                    {
                        echo '<div class="right">
                                <input type="button" value="Add Wine" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addWineModal"></input>
                            </div>';
                    }
                ?>
                <!-- Testing purposes -->
                <!-- <div class="right">
                    <input type="button" value="Add Wine" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addWineModal"></input>
                </div> -->
        </div>
        <div class="filters">
            <div class="left">
                <select name="wine-type" id="wine-type" onchange="searchWines()">
                    <option selected disabled>Wine Type</option>
                    <option value="red">Red</option>
                    <option value="white">White</option>
                    <option value="rose">Rose</option>
                    <option value="sparkling">Sparkling</option>
                </select>
            </div>
            
                <div class="right">
                    <select name="sort-wines" id="sort-wines" onchange="sortWines()">
                        <option selected disabled>Sort By...</option>
                        <option value="name-asc">Name - A to Z</option>
                        <option value="name-desc">Name - Z to A</option>
                        <option value="year-asc">Year - Old to New</option>
                        <option value="year-desc">Year - New to Old</option>
                        <option value="price-asc">Price - Low to High</option>
                        <option value="price-desc">Price - High to Low</option>
                    </select>
                </div>
            
        </div>

        <!-- Some more filters... -->
        <div class="filters">
            <div class="left">
                <input type="button" value="Clear All Filters"class="clear-filter" onclick="clearFilter()"></input>
            </div>
        </div>


    </div>

    <!-- List of Wines -->
    <div class="wine-holder grid container">
        <!-- Wines go here -->
    </div>
    
    <!-- Wine modal -->
    <div class="modal fade" id="wineModal" tabindex="-1" aria-labelledby="wineModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="wineModalLabel">Wine Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-sm-start">
                        <div class="col wine-col-1 text-center">
                            <img class="modal-image" src="" alt="wine image"/>
                        </div>
                        <div class="col wine-col-2 modal-details">
                        </div>
                        <div class="col wine-col-3 modal-reviews">
                        </div>
                    </div>

                    <?php
                    if(isset($_COOKIE["user_id"])&& $_COOKIE["Status"] ==="Logged-in")
                    {
                        echo ' <div class="row align-items-sm-start">
                                <div class="col text-center">
                                </div>
                                <div class="col">
                                </div>
                                <div class="col">
                                    <div class="star-rating">
                                        <span class="fa fa-star star" onmouseover="highlightStars(1)" onclick="setRating(1)"></span>
                                        <span class="fa fa-star star" onmouseover="highlightStars(2)" onclick="setRating(2)"></span>
                                        <span class="fa fa-star star" onmouseover="highlightStars(3)" onclick="setRating(3)"></span>
                                        <span class="fa fa-star star" onmouseover="highlightStars(4)" onclick="setRating(4)"></span>
                                        <span class="fa fa-star star" onmouseover="highlightStars(5)" onclick="setRating(5)"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="wineComment">Leave a comment</label>
                                        <textarea class="form-control" id="wineComment" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>';
                    }
                    ?>
                    
                    
                </div>
                <div class="modal-footer">
                <!-- Add Review if logged in -->
                <?php
                    if(isset($_COOKIE["user_id"])&& $_COOKIE["Status"] ==="Logged-in")
                    {
                        echo '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <input type="button" value="Add Review" onclick="addReview()" class="btn btn-success" id="addReviewButton"></input>';
                    }
                    else
                    {
                        echo '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>';
                    }

                ?>
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                
                <!-- Testing Purposes -->
                
                
                </div>
            </div>
        </div>
    </div>


    <!-- Add wine modal -->
    <div class="modal fade" id="addWineModal" tabindex="-1" aria-labelledby="addWineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addWineModalLabel">Add Wine</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Wine name -->
                        <div class="mb-3 form-group">
                            <label for="inputName" class="form-label">Wine Name:</label>
                            <input type="text" class="form-control" id="inputName"/>
                        </div>
                        <!-- Wine Description -->
                        <div class="mb-3 form-group">
                            <label for="inputDesc" class="form-label">Description:</label>
                            <textarea name="inputDesc" id="inputDesc" class="form-control"></textarea>
                        </div>
                        <!-- Wine Type -->
                        <div class="mb-3 form-group">
                            <label for="add-wine-type" class="form-label">Select Wine Type:</label>
                            <select name="add-wine-type" id="add-wine-type" class="form-control">
                                <option value="red">Red</option>
                                <option value="white">White</option>
                                <option value="rose">Rose</option>
                                <option value="sparkling">Sparkling</option>
                            </select>
                        </div>
                        <!-- Wine price -->
                        <div class="mb-3 form-group">
                            <label for="inputPrice" class="form-label">Wine Price:</label>
                            <input type="text" class="form-control" id="inputPrice">
                        </div>
                        <!-- Wine year -->
                        <div class="mb-3 form-group">
                            <label for="inputYear" class="form-label">Wine Year:</label>
                            <input type="text" class="form-control" id="inputYear">
                        </div>
                        <!-- Alcohol Content -->
                        <div class="mb-3 form-group">
                            <label for="inputAlc" class="form-label">Alcohol Content:</label>
                            <input type="text" class="form-control" id="inputAlc">
                        </div>

                        <!-- Wine Image link -->
                        <div class="mb-3 form-group">
                            <label for="inputLink" class="form-label">Wine Image link:</label>
                            <input type="text" class="form-control" id="inputLink">
                        </div>

                        <!-- Submit button -->
                        <input type="button" onclick="addWine()" value="Submit" class="btn btn-success"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <br/>

    <!-- Footer -->
    <?php include_once 'footer.php'; ?>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- Javascript file -->
    <script src="js/wines-script.js"></script>
</body>
</html>