<?php

if (isset($_POST))
{
    function valid($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    if (empty($_POST["FirstName"]))
    {
        $error = " Error: no first name entered";
        exit($error);
    }else
    {
        $name = valid($_POST["FirstName"]);
    }


    if (empty($_POST["LastName"]))
    {
        $error = " Error: no last name entered";
        exit($error);

    }else
    {
        $surname = valid($_POST["LastName"]);
    }

    if (empty($_POST["Password"]))
    {
        $error = " Error: no password entered";
        exit($error);
    }else
    {
        $password = $_POST["Password"];
    }

    if (empty($_POST["Email"]))
    {
        $error = " Error: no email entered";
        exit($error);
    }else
    {
        $email = valid($_POST["Email"]);
    }

    $con=new mysqli('wheatley.cs.up.ac.za','u21434558','FDTLBW5E5AFRTWNBOT4PZBHIJWY2Y4KT');
    if (!$con){
        die("Connection failed: ".$con->connect_error);
    }else{
        $con->select_db("u21434558");
        $query ="SELECT * FROM User WHERE email= '$email'" ;
        $result = $con->query($query);
        if ($result)
        {
            if ($result->num_rows >0)
            {
                $error = "Error: duplicate user found";
                // maybe redirect to login? how to handle if email exists in database
                exit($error);
            }else
            {
                $user_id = substr(time(),0,13);
                $password = crypt($password,$surname);
                //update passwords already in database
                $query ="INSERT INTO User (user_id,first_name,last_name,password,email) VALUES ('$user_id','$name',
                                                                       '$surname','$password','$email')";

                if ($con->query($query)===true)
                {
                    $cookie_v = "Logged-in";
                    setcookie("Status",$cookie_v, time() + (86400*30),"/");
                    setcookie("user_id",$user_id, time() + (86400*30),"/");
                    //store winery ID in the manager cookie
                    $query1 = "SELECT * FROM Wineries WHERE email= '$email'";
                    $res = $con->query($query1);
                    if( $res)
                    {
                        if($res->num_rows >0)
                        {
                            $row = $res->fetch_assoc();
                            setcookie("Manager",$row["winery_id"], time() + (86400*30),"/");
                        }
                    }
                    //redirect to home
                    header("Location:../frontend/home.php");
                }else
                {
                    exit("Error: ".$con->error);
                }

            }
        }
    }
$con->close();

}



?>
