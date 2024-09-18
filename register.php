<?php

$uname1 = $_POST['uname1'];
$email1 = $_POST['email1'];
$contact = $_POST['contact'];


if (!empty($uname1) || !empty($emali1) || !empty($contact))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "srikanth ";
    $dbname = "project";

    // create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_error()){
        die('Connect Error ('.
        mysqli_connect_error() .') '
        . mysqli_connect_error());
    }
    else{
        $SELECT = "SELECT contact From register Where contact = ? Limit 1";
        $INSERT = "INSERT Into register (uname1,email1,contact)
        values(?,?,?)";
        //prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $contact);
        $stmt->execute();
        $stmt->bind_result($contact);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        //checking username
        if ($rnum==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sss", $uname1,$email1,$contact);
            $stmt->execute();
            echo "New record inserted sucessfully";
        } else{
            echo "Someone already register using this phone number";
        }
        $stmt->close();
        $conn->close();
    }
} else{
    echo "All field are required";
    die();
}
?>



