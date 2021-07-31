<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';





// SELECT * FROM faculty_member INNER JOIN qualification ON faculty_member.fm_id = qualification.fm_id
// $allUsers = mysqli_query($con, "SELECT * FROM `faculty_member`");
$fm = mysqli_query($con, "SELECT * FROM faculty_member");
$qual = mysqli_query($con, "SELECT * FROM qualification");


    $faculty_member = mysqli_fetch_all($fm, MYSQLI_ASSOC);
    $qualification = mysqli_fetch_all($qual, MYSQLI_ASSOC);
    // $qualification = mysqli_fetch_all($qal, MYSQLI_ASSOC);
    echo json_encode(["fm" => $faculty_member, "qual" => $qualification ]);
    // echo json_encode(["success" => 1, "users" => ]);


?>