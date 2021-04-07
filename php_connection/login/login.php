<?php
$response = array();

    require_once __DIR__ . '/connection.php';
    
    $db = new DB_CONNECT();
    $con = $db->connect();

    if (isset($_POST['username'])&& isset($_POST['password'])){
        $usernamecustomer = $_POST['username'];
        $passwordcustomer = $_POST['password'];

        $query = "CALL 1418003_meat_login('select_login','$usernamecustomer','$passwordcustomer','','','','','')";
        $result = mysqli_query($con,$query)or die(mysqli_error($con));

        $response["verified"] = array();

        while($row = mysqli_fetch_array($result)){
            $order = array();
            $order["name"] = $row["name"];
            $order["email"] = $row["email"];

            array_push($response["verified"],$order);
            $success = true;
        }

        if($success){
            $response["success"] = 1;
            $response["message"] = "login_success";
        }
        else{
            $response["success"]= 0;
            $response["message"]= "login_failed";
        }
        echo json_encode($response, JSON_UNESCAPED_SLASHES);
        
    }


?>