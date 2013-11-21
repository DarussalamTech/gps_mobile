<?php
/*
require_once("SocketServer.class.php"); // Include the File
$server = new SocketServer("192.168.1.34",8080); // Create a Server binding to the given ip address and listen to port 31337 for connections
$server->max_clients = 10; // Allow no more than 10 people to connect at a time
$server->hook("CONNECT","handle_connect"); // Run handle_connect every time someone connects
$server->hook("INPUT","handle_input"); // Run handle_input whenever text is sent to the server
$server->infinite_loop(); // Run Server Code Until Process is terminated.
*/

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if (!socket_connect($socket, 'localhost', 8080) || !socket_connect($socket, 'localhost', 80))) {
    die('failed');
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!empty($_POST)){

try {
    if (!$con = mysql_connect("localhost", "admin", "admin", "gps_db")) {
        echo json_encode(array("error" => mysql_error(), "type" => "mysql error"));
    }

    mysql_select_db('gps_db');
    // Check connection

    $sql = "INSERT INTO table1 " .
            "(longitude,latitude,device_id) " .
            "VALUES('{$_POST['longitude']}','{$_POST['latitude']}','{$_POST['device_mac']}')";

    if (mysql_query($sql, $con)) {
        echo json_encode(array("id" => mysql_insert_id(), "status" => "inserted"));
    }



    mysql_close();
} catch (Exception $ex) {

    echo json_encode(array("error" => $ex, "type" => "Exception"));
}
}
else{
    
    echo json_encode(array("error" => "POST IS EMPTY", "type" => "POST"));
}
?>
