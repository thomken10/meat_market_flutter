<?php 
$response = array();
    require_once __DIR__ . '/connection.php';
    $db = new DB_CONNECT();
    $con = db->connect();

    if(isset($_POST['x1'])&&isset($_POST['x2'])){
        $emailaddresscustomer = $_POST['x1'];
        $passwordcustomer = $_POST['x2'];

        $productid = $_POST['x3'];

        $query = "CALL 1418003_meat_one_product('select_one_product,'','','$productid','','','','')"
        $result = mysqli_query($con, $query) or die(mysqli_error($con));

        $response["data"] = array();
        while($row = mysqli_fetch_array($result)){
            $order=array();
            $order["id_meat"] = $row["id_product"];
            $order["meat_type"] = $row["meat_type"];
            $order['meat_from'] = $row["meat_from"];
            $order['meat_price'] = $row["meat_price"];
            $order['meat_category'] = $row["meat_category"];
            $order["meat_picture"] = $row["meat_picture"];
            $order['meat_desc']= $row["meat_desc"];
            $order['meat_stock'] = $row["meat_stock"];
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