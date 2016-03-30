<?php
// Create connection
try{
    $con = new mysqli("localhost", "app", "9bhsTRAj3e7X8h7G", "qbnb");
}catch(Exception $ex){
    echo "Connection error: " . $ex->getMessage();
}

$data = json_decode(file_get_contents('php://input'), true);
if ($data['action'] == "login"){

    $query = "SELECT ID FROM user WHERE email = ? AND passwordHash = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $data['email'],  $data['passwordHash']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['ID'];

        $q = "UPDATE USER SET lastLogin = CURRENT_TIME() WHERE email = ?";
        $s = $con->prepare($q);
        $s->bind_param("s", $data['email']);
        $s->execute();
        if ($con->affected_rows > 0) {
            echo "success";
        }
        else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}
if ($data['action'] == "logout"){
    echo $data;
    $_SESSION['id']=null;
    session_destroy();
    echo "success";
}
