

<?php
// Create connection
try{
    $con = new mysqli("localhost", "app", "9bhsTRAj3e7X8h7G", "qbnb");
}catch(Exception $ex){
    echo "Connection error: " . $ex->getMessage();
}

$data = json_decode(file_get_contents('php://input'), true);
if ($data['action'] == "viewAllUsers"){
    $query = "SELECT * FROM user JOIN Faculty ON user.facultyID = faculty.ID JOIN Degree ON degree.ID = user.degreeID JOIN Role on role.ID = user.roleID";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $json = array();
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $user = array(
                'ID' => $row['ID'],
                'firstName' => $row['firstName'],
                'lastName' => $row['lastName'],
                'email' => $row['email'],
                'createdDate' => $row['createdDate']
            );
            array_push($json, $row);
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else {
        echo "0 results";
    }
}

if ($data['action'] == "summarizeBooking") {
    $stmt = $con->prepare("SELECT * FROM booking WHERE consumerID = ?");
    $stmt->bind_param("s", $data['consumerID']);
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

?>