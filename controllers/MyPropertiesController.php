
<?php
// Create connection
try{
    $con = new mysqli("localhost", "app", "9bhsTRAj3e7X8h7G", "qbnb");
}catch(Exception $ex){
    echo "Connection error: " . $ex->getMessage();
}


$data = json_decode(file_get_contents('php://input'), true);
if ($data['action'] == "viewAllProperties"){
    $query = "SELECT DISTINCT property.ID, property.address, property.nightlyRate, district.districtName, propertytype.buildingType, propertytype.numBedrooms FROM Property JOIN District ON district.ID = property.districtID JOIN PropertyType ON propertytype.ID = property.typeID";
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
                'district' => $row['districtName'],
                'buildingType' => $row['buildingType'],
                'numBedrooms' => $row['numBedrooms']
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
