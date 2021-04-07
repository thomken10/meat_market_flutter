<?php
$response = array();
    require_once __DIR__. 'connection.php';

    $db = new DB_CONNECT();
    $con = $db->connect();

    if (isset($_POST['x1']) && isset($_POST['x2'])){
        $emailaddresscustomer = $_POST['x1'];
        $passwordcustomer = $_POST['x2'];

        if($_POST['x3'] == null || $_POST['x4'] == null){
            $limit = 1000; 
            $_POST['x3'];
            $offset = 1;
            $_POST['x4']
        }
        else{
            $limit = $_POST['x3'];
            $offset = $_POST['x4'];
        }
        $query = "CALL 1418003_meat_product('select_meat_product,'','',$limit',$offset,'','','','')";
        $result = mysqli_query($con,$query) or die(mysqli_error($con));

        $response["data"] = array();
        while ($row = mysqli_fetch_array($result)){
            $order = array();
            $order["id_meat"] = $row["id_product"];
            $order["meat_type"] = $row["meat_type"];
            $order['meat_from'] = $row["meat_from"];
            $order['meat_price'] = $row["meat_price"];
            $order["meat_picture"] = $row["meat_picture"];
        }
        array_push($response["data"], $order);
        $success = true;

        if($success){
            $response["success"]= 1;
            $response["message"]="Retreving success"
        }
        else{
            $response["success"] = 0;
            $response["message"] = "Retreiving failed"
        }
        echo json_encode($response, JSON_UNESCAPED_SLASHES);
    }
?>