
<?php
// Create connection
try{
    $con = new mysqli("localhost", "app", "9bhsTRAj3e7X8h7G", "qbnb");
}catch(Exception $ex){
    echo "Connection error: " . $ex->getMessage();
}


$data = json_decode(file_get_contents('php://input'), true);
if ($data['action'] == "viewBookings"){
    $query = "SELECT DISTINCT booking.ID, property.address, property.nightlyRate, booking.startDate, booking.endDate, booking.status FROM Booking JOIN Property ON booking.propertyID == property.ID";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $json = array();
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $property = array(
                'ID' => $row['ID'],
                'address' => $row['address'],
                'nightlyRate' => $row['nightlyRate'],
                'startDate' => $row['districtName'],
                'endDate' => $row['buildingType'],
                'status' => $row['numBedrooms']
            );
            array_push($json, $property);
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else {
        echo "0 results";
    }
}

?>
