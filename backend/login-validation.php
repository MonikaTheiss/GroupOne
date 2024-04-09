<?php


if(isset ($_POST))
{
    function valid($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (empty($_POST['Username']))
    {
        $error ="Error: no email address entered";
        exit($error);
    }else
    {
        $email = valid($_POST["Username"]);
    }

    if(empty($_POST["Userpassword"]))
    {
        $error="Error: no password entered";
        exit($error);
    }else
    {
        $password = $_POST["Userpassword"];
    }

    $con = new mysqli('wheatley.cs.up.ac.za','u21434558','FDTLBW5E5AFRTWNBOT4PZBHIJWY2Y4KT');
    if (!$con)
    {
        die("Connection failed". $con->connect_error);
    }else
    {
        $con->select_db("u21434558");
        $query = "SELECT * FROM User WHERE email='$email'";
        $result = $con->query($query);
        if($result)
        {
            if ($result->num_rows <=0)
            {
                //let user know the user doent exist
                header("Location:../frontend/signup.html");
            }else
            {
                while ($row = mysqli_fetch_array($result)){
                   
                    if (crypt($password,$row["last_name"]) === $row["password"] )
                    {
                        $query1 = "SELECT * FROM Wineries WHERE email= '$email'";
                        $res = $con->query($query1);
                        if($res)
                        {
                            if($res->num_rows >0)
                            {
                                $row2 = $res->fetch_assoc();
                                setcookie("Manager",$row2["winery_id"], time() + (86400*30),"/");
                            }
                        }
                        $cookie_v = "Logged-in";
                        setcookie("Status",$cookie_v, time() + (86400*30),"/");
                        setcookie("user_id",$row["user_id"], time() + (86400*30),"/");
                        header("Location:../frontend/home.php");
                        //store winery ID in the manager cookie
                    }else
                    {
                        echo "Invalid details added ";
                        //show message that invalid details are entered
                        header("Location:../frontend/login.html");

                    }
                }

            }
        }



    }
    $con->close();
}else
    echo "POST is empty"
?>