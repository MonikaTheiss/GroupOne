<?php
    require_once __DIR__.'/config.php';
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    
    
    $status = "";
    if(isset($data['type']))
    {
        $filters = null;
        if(isset($data['filters']))
        {
            $filters = $data['filters'];//filters is an associative array of attributes used to search the db.
        }

        $type = $data['type'];
        if($type == 'getWineries')
        {
            $data = API::getWineries($filters);
            $status = "success";
        }
        else if($type == 'getWines')
        {
            $data = API::getWines($filters);
            $status = "success";
        }else if($type == 'addReview')
        {
            $user_id =$data["user_id"];
            $wine_id = $data['wine_id'];
            $comment = $data['comment'];
            $rating = $data['rating'];
            API::addReview($user_id,$wine_id,$comment,$rating);
            $status = "success";
        }
        else if($type == 'addWines')
        {
            if(isset($data['properties']))
            {
                $data = API::addWines($data['properties']);
                $status = "success";
            }
            else
            {
                $data = "Error: No Properties included";
                $status = "error";
            }
        }
        else if($type == 'getReviews')
        {
            if(isset($data['wine_id']))
            {
                $data = API::getReviews($data['wine_id']);
                $status = "success";
            }
            else
            {
                $data = "Error: No wine ID included";
                $status = "error";
            }
        }
        else
        {
            $data = "Error: Invalid type";
            $status = "error";
        }
    }
    else
    {
        $data = "Error: Type not included";
        $status = "error";
    }
    

    $returnObject = array(
        "status" => $status,
        "data" => $data
    );

    echo json_encode($returnObject);

    /*
        *
        *
        *
        API FUNCTIONS
        *
        *
        *
    */

    class API
    {
        public static function getWineries($filters)
        {
            $validFields = ["winery_id","name","address","location","description","email","phone_number","verified","region_id","web_link","winery_image"];
            try
            {
                $db = new Connect;
                if(isset($filters))
                {
                    $db = new Connect;
                    $filterArray = array();
                    $users = array();
                    
                    $sqlQueryString = "SELECT Wineries.address, Wineries.description, Wineries.email, Wineries.location, Wineries.name,Wineries.phone_number,
                    Wineries.region_id,Wineries.verified,Wineries.web_link,Wineries.winery_id,Wineries.winery_image, Country.name AS countryName
                    FROM u21434558.Wineries
                    INNER JOIN Regions
                    ON Wineries.region_id = Regions.region_id
                    INNER JOIN Country
                    ON Regions.country_id = Country.country_id WHERE ";

                    foreach($filters as $searchTerm => $searchValue)
                    {
                        $sqlQueryString .= $searchTerm . " LIKE ? AND ";
                        $tempString = "%".$searchValue."%";
                        array_push($filterArray,$tempString);
                    }
                    $sqlQueryString = substr($sqlQueryString, 0, strlen($sqlQueryString) - 4);
                    $sqlQueryString .= ";";

                    //echo $sqlQueryString;
                    //var_dump($filterArray);
                    $data = $db->prepare($sqlQueryString);
                    $data->execute($filterArray);
                    $increment = 0;
                    while($OutputData = $data->fetch(PDO::FETCH_ASSOC))
                    {
                        $users[$increment] = array(
                            "winery_id" => $OutputData["winery_id"],
                            "name" => $OutputData["name"],
                            "address" => $OutputData["address"],
                            "location" => $OutputData["location"],
                            "description" => $OutputData["description"],
                            "email" => $OutputData["email"],
                            "phone_number" => $OutputData["phone_number"],
                            "verified" => $OutputData["verified"],
                            "region_id" => $OutputData["region_id"],
                            "web_link" => $OutputData["web_link"],
                            "winery_image" => $OutputData["winery_image"],
                            "countryname" => $OutputData["countryName"]
                        );
                        $increment++;
                    }
                    return $users;
                }
                else
                {
                    $db = new Connect;
                    $users = array();
                    $sqlQueryString = 'SELECT Wineries.address, Wineries.description, Wineries.email, Wineries.location, Wineries.name,Wineries.phone_number,
                    Wineries.region_id,Wineries.verified,Wineries.web_link,Wineries.winery_id,Wineries.winery_image, Country.name AS countryName
                    FROM u21434558.Wineries
                    INNER JOIN Regions
                    ON Wineries.region_id = Regions.region_id
                    INNER JOIN Country
                    ON Regions.country_id = Country.country_id;';
                    $data = $db->prepare($sqlQueryString);
                    $data->execute();
                    $increment = 0;
                    while($OutputData = $data->fetch(PDO::FETCH_ASSOC))
                    {
                        $users[$increment] = array(
                            "winery_id" => $OutputData["winery_id"],
                            "name" => $OutputData["name"],
                            "address" => $OutputData["address"],
                            "location" => $OutputData["location"],
                            "description" => $OutputData["description"],
                            "email" => $OutputData["email"],
                            "phone_number" => $OutputData["phone_number"],
                            "verified" => $OutputData["verified"],
                            "region_id" => $OutputData["region_id"],
                            "web_link" => $OutputData["web_link"],
                            "winery_image" => $OutputData["winery_image"],
                            "countryname" => $OutputData["countryName"]
                        );
                        $increment++;
                    }
                    return $users;
                }
            }
            catch(PDOException $e)
            {
                echo "Error " .$e->getMessage();
            }
            
        }

        public static function getWines($filters)
        {
            $validFields = ["wine_id","name","description","price","winery_id","verified","region_id","web_link","winery_image"];
            try
            {
                $db = new Connect;
                if(isset($filters))
                {

                    /*
                    $db = new Connect;
                    $users = array();
                    $sqlQueryString = "SELECT * FROM wines WHERE wines.name LIKE :enteredName;";
                    $data = $db->prepare($sqlQueryString);
                    $data->execute(array(':enteredName' => '%'.$filters.'%'));
                    $increment = 0;
                    while($OutputData = $data->fetch(PDO::FETCH_ASSOC))
                    {
                        $users[$increment] = array(
                            "name" => $OutputData["name"]
                        );
                        $increment++;
                    }
                    return $users;
                    */

                    $db = new Connect;
                    $filterArray = array();
                    $users = array();
                    
                    $sqlQueryString = "SELECT * FROM Wines WHERE ";

                    foreach($filters as $searchTerm => $searchValue)
                    {
                        $sqlQueryString .= $searchTerm . " LIKE ? AND ";
                        $tempString = "%".$searchValue."%";
                        array_push($filterArray,$tempString);
                    }
                    $sqlQueryString = substr($sqlQueryString, 0, strlen($sqlQueryString) - 4);
                    $sqlQueryString .= ";";

                    //echo $sqlQueryString;
                    //var_dump($filterArray);
                    $data = $db->prepare($sqlQueryString);
                    $data->execute($filterArray);
                    $increment = 0;
                    while($OutputData = $data->fetch(PDO::FETCH_ASSOC))
                    {
                        $users[$increment] = array(
                            "wine_id" => $OutputData["wine_id"],
                            "name" => $OutputData["name"],
                            "description" => $OutputData["description"],
                            "price" => $OutputData["price"],
                            "winery_id" => $OutputData["winery_id"],
                            "alcohol_content" => $OutputData["alcohol_content"],
                            "type" => $OutputData["type"],
                            "year" => $OutputData["year"],
                            "image" => $OutputData["image"]
                        );
                        $increment++;
                    }
                    return $users;
                }
                else
                {
                    /*
                    $db = new Connect;
                    $users = array();
                    $sqlQueryString = 'SELECT * FROM wines;';
                    $data = $db->prepare($sqlQueryString);
                    $data->execute();
                    $increment = 0;
                    while($OutputData = $data->fetch(PDO::FETCH_ASSOC))
                    {
                        $users[$increment] = array(
                            "name" => $OutputData["name"]
                        );
                        $increment++;
                    }
                    return $users;
*/
                    $db = new Connect;
                    $users = array();
                    $sqlQueryString = 'SELECT * FROM Wines;';
                    $data = $db->prepare($sqlQueryString);
                    $data->execute();
                    $increment = 0;
                    while($OutputData = $data->fetch(PDO::FETCH_ASSOC))
                    {
                        $users[$increment] = array(
                            "wine_id" => $OutputData["wine_id"],
                            "name" => $OutputData["name"],
                            "description" => $OutputData["description"],
                            "price" => $OutputData["price"],
                            "winery_id" => $OutputData["winery_id"],
                            "alcohol_content" => $OutputData["alcohol_content"],
                            "type" => $OutputData["type"],
                            "year" => $OutputData["year"],
                            "image" => $OutputData["image"]
                        );
                        $increment++;
                    }
                    return $users;
                }
            }
            catch(PDOException $e)
            {
                echo "Error " .$e->getMessage();
            }
        }

        public static function addWines($properties)
        {
            $minimumProperties = ["name","description","price","winery_id","alcohol_content","type","year", "image"];
            try
            {
                $isright = true;
                $db = new Connect;
                $filterArray = array();
                $users = array();
                
                $sqlQueryString = "INSERT INTO Wines (`name`, `description`, `price`, `winery_id`, `alcohol_content`, `type`, `year`, `image`) 
                VALUES (:name, :description, :price, :winery_id, :alcohol_content, :type, :year, :image);";
                //insert
                foreach($properties as $propname => $propval)
                {
                    
                    $filterArray[":".$propname] = $propval;
                }

                echo $sqlQueryString;
                var_dump($filterArray);
                $data = $db->prepare($sqlQueryString);
                $data->execute($filterArray);
                /*
                $increment = 0;
                while($OutputData = $data->fetch(PDO::FETCH_ASSOC))
                {
                    $users[$increment] = array(
                        "winery_id" => $OutputData["winery_id"],
                        "name" => $OutputData["name"],
                        "address" => $OutputData["address"],
                        "location" => $OutputData["location"],
                        "description" => $OutputData["description"],
                        "email" => $OutputData["email"],
                        "phone_number" => $OutputData["phone_number"],
                        "verified" => $OutputData["verified"],
                        "region_id" => $OutputData["region_id"],
                        "web_link" => $OutputData["web_link"],
                        "winery_image" => $OutputData["winery_image"]
                    );
                    $increment++;
                }
                return $users;
                */
            }
            catch(PDOException $e)
            {
                echo "Error " .$e->getMessage();
            }
        }

        public static function addReview($user_id,$wine_id,$comment,$rating)
        {  
            $db = new Connect;
            function valid($data)
            {
                $data = trim($data);
                $data = stripcslashes($data);
                $data=htmlspecialchars($data);
                return $data;
            }
            try{
            $comment = valid($comment);
            $query = "INSERT INTO REVIEWS (user_id,wine_id,comment,rating) VALUES (?,?,?,?)";
            $result = $db->prepare($query);
            $result->execute(array($user_id,$wine_id,$comment,$rating));
            }catch(PDOException $e)
            {
                echo $e;
                //error in adding review
            }
            echo "success";
            //review added successfully
            }

            public static function getReviews($wineID)
            {
                $db = new Connect;
                try{
                    $query = "SELECT * FROM REVIEWS WHERE REVIEWS.wine_id = ?;";
                    $result = $db->prepare($query);
                    $result->execute(array($wineID));
                    $users = array();
                    $increment = 0;
                    while($OutputData = $result->fetch(PDO::FETCH_ASSOC))
                    {
                        $users[$increment] = array(
                            "user_id" => $OutputData["user_id"],
                            "wine_id" => $OutputData["wine_id"],
                            "comment" => $OutputData["comment"],
                            "rating" => $OutputData["rating"],
                            "rating_id" => $OutputData["rating_id"]
                        );
                        $increment++;
                    }
                    return $users;
                }
                catch(PDOException $e)
                {
                    echo $e;
                }
            }
        }


    
?>