
application/x-httpd-php connection.php ( PHP script, ASCII text, with CRLF line terminators )
<?php 
    class DB_CONNECT{
        function __construct(){
            $this->connect();
        }
        function __destruct(){
            $this->close();
        }
        function connect(){
            require_once __DIR__ . '/config.php';

            $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error());

            $db = mysqli_select_db($con, DB_DATABASE) or die(mysqli_error($con)) or die(mysqli_error($con));

            return $con;
        }
        function close(){
            mysqli_close($this->connect()); 
        }
    }
?>