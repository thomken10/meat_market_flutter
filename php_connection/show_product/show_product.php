<?php
$response = array();
    require_once __DIR__. '/connection.php';

    $db = new DB_CONNECT();
    $con = $db->connect();

    if (isset($_POST['x1']) && isset($_POST['x2'])){
        $emailaddresscustomer = $_POST['x1'];
        $passwordcustomer = $_POST['x2'];

        if($_POST['x3'] == null || $_POST['x4'] == null){
            $limit = 1000; 
            $_POST['x3'];
            $offset = 1;
            $_POST['x4'];
        }
        else{
            $limit = $_POST['x3'];
            $offset = $_POST['x4'];
        }
        $query = "CALL 1418003_meat_product('select_meat_product','','',$limit,'$offset','','','','','','')";
        $result = mysqli_query($con,$query) or die(mysqli_error($con));
        

        $response["data"] = array();
        echo "after response [data]";
        while ($row = mysqli_fetch_array($result)){
            
            $order = array();
            $order["id_product"] = $row["id_product"];
            $order["product_name"] = $row["product_name"];
            $order['product_from'] = $row["product_from"];
            $order['product_cut'] = $row["product_cut"];
            $order["product_image"] = $row["product_image"];
            $order['product_price'] = $row["product_price"];
            
            
            array_push($response["data"], $order);
            $success = true;
        }
        

        if($success){
            $response["success"]= 1;
            $response["message"]="Retreving success";
        }
        else{
            $response["success"] = 0;
            $response["message"] = "Retreiving failed";
        }
        echo json_encode($response, JSON_UNESCAPED_SLASHES);
    }
?>