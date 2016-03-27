<?php
// Create connection
try{
    $con = new mysqli("localhost", "app", "9bhsTRAj3e7X8h7G", "qbnb");
}catch(Exception $ex){
    echo "Connection error: " . $ex->getMessage();
}

echo file_get_contents('php://input');
$data = json_decode(file_get_contents('php://input'), true);

if ($data['action'] == "getUserDetails"){
    $query = "SELECT * FROM USER WHERE ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $data['ID']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $json = array();
        // output data of each row
        while($row = $result->fetch_assoc()) {
            array_push($json, $row);
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else {
        echo "0 results";
    }
}

if ($data['action'] == "updateUserDetails"){
    $query = "UPDATE user SET
        userName = ?,
        firstName = ?,
        lastName = ?,
        email = ?,
        homePhone = ?,
        workPhone = ?,
        cellPhone = ?,
        gradYear = ?,
        facultyID = ?,
        degreeID = ?, WHERE ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('sssssssssss',
        $data['userName'],
        $data['firstName'],
        $data['lastName'],
        $data['email'],
        $data['homePhone'],
        $data['workPhone'],
        $data['cellPhone'],
        $data['gradYear'],
        $data['facultyID'],
        $data['degreeID'],
        $data['ID']);
    $stmt->execute();
    $result = $stmt->get_result($sql);
    if ($result->num_rows > 0) {
        echo "Update successful.";
    } else {
        echo "Update failed.";
    }
}

if ($data['action'] == "deleteAccount"){
    $query = "DELETE FROM USER WHERE ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $data['ID']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Deletion successful";
    } else {
        echo "Deletion failed.";
    }
}

if ($data['action'] == "updatePassword") {
    $query = "UPDATE user SET passwordHash = ? WHERE ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $data['passwordHash'], $data['ID']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Update successful.";
    } else {
        echo "Update failed.";
    }
}