<?php
// Create connection
try{
    $con = new mysqli("localhost", "app", "9bhsTRAj3e7X8h7G", "qbnb");
}catch(Exception $ex){
    echo "Connection error: " . $ex->getMessage();
}

echo file_get_contents('php://input');
$data = json_decode(file_get_contents('php://input'), true);

if ($data['action'] == "searchForPorperty"){
    $query = "SELECT * FROM property INNER JOIN propertytype ON property.typeID = propertytype.ID INNER JOIN district on district.ID = property.districtID WHERE propertytype.buildingType = ? OR district.name = ? OR property.nightlyRate < ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssi", $data['buildingType'], $data['distrinctName'], $data['nightlyRate']);
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

if ($data['action'] == "searchByAvailability"){
    $query = "SELECT * FROM property WHERE property.ID NOT IN (SELECT * FROM property JOIN booking ON property.ID = booking.propertyID WHERE booking.startDate <= ? AND booking.endDate >= ? )";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $data['startDate'], $data['endDate']);
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

if ($data['action'] == "viewProperty"){
    $query = "SELECT address, nightlyRate FROM property WHERE property.ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $data['propertyID']);
    $stmt->execute();
    $propertyResult = $stmt->get_result();

    $query = "SELECT name FROM property JOIN propertyfeature on property.ID = propertyfeature.PropertyID JOIN feature on propertyfeature.FeatureID = feature.ID WHERE property.ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $data['propertyID']);
    $stmt->execute();
    $featureResult = $stmt->get_result();

    $query = "SELECT rating, description FROM property JOIN comment on property.ID = comment.PropertyID WHERE property.ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $data['propertyID']);
    $stmt->execute();
    $commentResult = $stmt->get_result();

    $query = "SELECT Description FROM comment JOIN reply on comment.ID = reply.CommentId WHERE comment.propertyID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $data['propertyID']);
    $stmt->execute();
    $replyResult = $stmt->get_result();

    $query = "SELECT buildingType, numBedrooms FROM property JOIN propertyType on property.typeID = propertytype.ID WHERE property.ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $data['propertyID']);
    $stmt->execute();
    $typeResult = $stmt->get_result();

    $query = "SELECT name FROM property JOIN district on property.districtID = district.ID WHERE property.ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $data['propertyID']);
    $stmt->execute();
    $districtResult = $stmt->get_result();

    $query = "SELECT name, description FROM property JOIN pointofinterest on property.districtID = pointofinterest.districtID WHERE property.ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $data['propertyID']);
    $stmt->execute();
    $poiResult = $stmt->get_result();

    $json = array();

    if ($propertyResult->num_rows > 0) {
        $row = $propertyResult->fetch_assoc();
        array_push($json, $row);
    }

    if ($featureResult->num_rows > 0) {
        $list = array();
        while($row = $featureResult->fetch_assoc()) {
            array_push($list, $row);
        }
        array_push($json, $list);
    }

    if ($commentResult->num_rows > 0) {
        $list = array();
        while($row = $commentResult->fetch_assoc()) {
            array_push($list, $row);
        }
        array_push($json, $list);
    }

    if ($replyResult->num_rows > 0) {
        $list = array();
        while($row = $replyResult->fetch_assoc()) {
            array_push($list, $row);
        }
        array_push($json, $list);
    }

    if ($typeResult->num_rows > 0) {
        $row = $typeResult->fetch_assoc();
        array_push($json, $row);
    }

    if ($districtResult->num_rows > 0) {
        $row = $districtResult->fetch_assoc();
        array_push($json, $row);
    }


    if ($poiResult->num_rows > 0) {
        $list = array();
        while($row = $poiResult->fetch_assoc()) {
            array_push($list, $row);
        }
        array_push($json, $list);
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

}


if ($data['action'] == "createBookingRequest"){
    $query = "INSERT INTO booking VALUE(?, ?, ?, ?, ?, ?, 1)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssss", $data['ID'], $data['propertyID'], $data['supplierID'], $data['consumerID'], $data['startDate'], $data['endDate']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Request created.";
    } else {
        echo "Request failed.";
    }
}

?>