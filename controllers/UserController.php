

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
                'createdDate' => $row['createdDate'],
                'gradYear' => $row['gradYear'],
                'faculty' => $row['facultyName'],
                'degree' => $row['degreeName']
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

if ($data['action'] == "getAllBookings") {
    $query = "SELECT * FROM booking";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $json = array();
        while($row = $result->fetch_assoc()) {
            array_push($json, $row);
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else {
        echo "0 results";
    }
}

if ($data['action'] == "getFutureBookings") {
    $query = "SELECT * FROM booking where startDate > CURRENT_DATE()";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $json = array();
        while($row = $result->fetch_assoc()) {
            array_push($json, $row);
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else {
        echo "0 results";
    }
}

// Delete all of a user's bookings
if ($data['action'] == "deleteUserBookings") {
    $query = "DELETE * FROM booking where consumerID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $data['consumerID']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Deletion successful.";
    } else {
        echo "Deltion failed.";
    }
}

if ($data['action'] == "getUserProperties") {
    $query = "SELECT * FROM property where supplierID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $data['supplierID']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $json = array();
        while($row = $result->fetch_assoc()) {
            array_push($json, $row);
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else {
        echo "0 results";
    }
}

if ($data['action'] == "deleteUserProperties") {
    $query = "DELETE * FROM property where consumerID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $data['consumerID']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Deletion successful.";
    } else {
        echo "Deltion failed.";
    }
}


if ($data['action'] == "editUser"){
    $q = "SELECT Role.ID AS roleID, Degree.ID AS degreeID, Faculty.ID as facultyID FROM USER JOIN Faculty ON facultyName = ? JOIN Degree ON degreeName = ? JOIN Role ON roleName = ?";
    $s = $con->prepare($q);
    $s-> bind_param('sss',$data['faculty'], $data['degree'], $data['role']);
    $s->execute();
    $result = $s->get_result();
    if ($result->num_rows > 0) {
        $json = array();
        $row = $result->fetch_assoc();
        $query = "UPDATE user SET
        firstName = ?,
        lastName = ?,
        email = ?,
        gradYear = ?,
        facultyID = ?,
        degreeID = ?,
        roleID = ? WHERE email = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ssssssss',
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['gradYear'],
            $row['facultyID'],
            $row['degreeID'],
            $row['roleID'],
            $data['email']);
        $stmt->execute();
        if ($stmt->errno) {
            echo "FAILURE!!! " . $stmt->error;
        }
        else echo "Updated {$stmt->affected_rows} rows";

    } else {
        echo "0 results";
    }


}

if ($data['action'] == "createUser"){
    $query = "INSERT INTO User (ID, userName, firstName, lastName, email, gradYear, passwordHash, createdDate, facultyID, roleID, degreeID) VALUES(ID = ?, userName = ?,
        firstName = ?,
        lastName = ?,
        email = ?,
        gradYear = ?,
        passwordHash = 'P@ssw0rd',
        createdDate = ?,
        facultyID = '8cee73ff-cb81-11e5-8c5c-101f74183244',
        roleID ='3',
        degreeID = '1')";
    $ID = (string)md5($data['email']);
    $stmt = $con->prepare($query);
    $stmt->bind_param('sssssss',
        $ID,
        $data['email'],
        $data['firstName'],
        $data['lastName'],
        $data['email'],
        $data['gradYear'],
        date("Y/m/d"));
    $stmt->execute();
    if ($stmt->errno) {
        echo "FAILURE!!! " . $stmt->error;
    }
    else{
        echo "Created {$stmt->affected_rows} rows";
        $q = "SELECT Role.ID AS roleID, Degree.ID AS degreeID, Faculty.ID as facultyID FROM USER JOIN Faculty ON facultyName = ? JOIN Degree ON degreeName = ? JOIN Role ON roleName = ? WHERE user.email = ?";
        $s = $con->prepare($q);
        $s-> bind_param('ssss',$data['faculty'], $data['degree'], $data['role'], $data['email']);
        $s->execute();
        $result = $s->get_result();
    }
}
?>