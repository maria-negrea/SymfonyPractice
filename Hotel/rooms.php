<?php
include("BookingController.php");

$checkinDate = $_POST['checkinDate'];
 $checkoutDate = $_POST['checkoutDate'];
 $roomTypeId = $_POST['roomTypeId'];
 $hasWireless = $_POST['hasWireless'];
 $hasTV = $_POST['hasTV'];
 $hasAirConditioning = $_POST['hasAirConditioning'];
 $hasMinibar = $_POST['hasMinibar'];
 
 $c = new BookingController();
 $rooms = $c->getRooms($checkinDate, $checkoutDate, $roomTypeId, $hasWireless, $hasTV, $hasAirConditioning, $hasMinibar);
 
 echo $rooms;