<?php

try {
    $con = new mysqli("localhost","app","*8232A1298A49F710DBEE0B330C42EEC825D4190A", "qbnb");
}

// show error
catch(Exception $exception){
    echo "Connection error: " . $exception->getMessage();
}

