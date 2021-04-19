<?php

/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();

    // include db connect class
    require_once __DIR__ . '/connection.php';
    
    // connecting to db
    $db  = new DB_CONNECT();
    $con = $db->connect();
    
    if (isset($_POST['x1']) && isset($_POST['x2'])){
        $emailaddresscustomer = $_POST['x1'];
        $password = $_POST['x2'];

    //if (true){
    //    $emailaddressofmember = 'a';
    //    $password = 'a';
    
        $query = "CALL 1418003_meat_carousel('select_carousel','','','','','','','','','','')";
        $result = mysqli_query($con,$query) or die(mysqli_error($con));
		  
    	
        // Tampilkan data dengan pengulangan while
        $response["data"] = array();
            
        while ($row = mysqli_fetch_array($result)) {
        // temp user array
            $order = array();
            $order["id_adv"] = $row["id_carousel"];
            $order["title"] = $row["Carousel_title"];
            $order["imgadv"] = $row["carousel_image"];
            //$order["emailaddressofmember"] = $row["emailaddressofmember"];
            //$order["issuperadmin"] = $row["issuperadmin"];
            //$order["avatar"] = $row["avatar"];
            //$order["hp1"] = $row["hp1"];
            //$order["hp2"] = $row["hp2"];
            //$order["isasrunner"] = $row["isasrunner"];
            //$order["isassponsor"] = $row["isassponsor"];
        
        // push single product into final response array
            array_push($response["data"], $order);
            $success = true;
        }
            
          
        if ($success) {
            $response["success"] = 1;
            $response["message"] = "Retreiving success";
        }
        else {
            $response["success"] = 0;
            $response["message"] = "Retreiving failed";
        }
        echo json_encode($response,JSON_UNESCAPED_SLASHES);
      
    } 
?>