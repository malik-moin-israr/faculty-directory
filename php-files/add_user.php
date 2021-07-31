<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require 'db_connection.php';
$data = json_decode(file_get_contents("php://input"));
// define("RAND", rand());
$rand= rand();
// $randoriginal = rand();
$qualificationarray = $data->qualification;
$counter = 0;
// foreach ($qualificationarray as $value) {
// 	${'qualification' . $counter } = $value;
	// $counter++;
// }

// echo json_encode(["success" => 1, "users" => $qualificationarray[0]->institute]);
// echo $qualification;
// database insert SQL code
// insert in database 
if(!($data->fm_name == "")){
	$rs = mysqli_query($con, "INSERT INTO `faculty_member` (`fm_id`,`fm_name`, `fm_address`, `fm_designation`, `fm_salary`)  VALUES ( '$rand','$data->fm_name', '$data->fm_address', '$data->fm_designation', '$data->fm_salary')");

	for ($x = 0; $x < sizeof($qualificationarray); $x+=1) {
		$degree = $qualificationarray[$x]->degree_tittle;
		$year = $qualificationarray[$x]->year_of_passing;
		$institute = $qualificationarray[$x]->institute_attended;
	
		$rs2 = mysqli_query($con, "INSERT INTO `qualification` (`q_id`,`fm_id`,`degree_tittle`,`year_of_passing`,`institute_attended`) VALUES (0,'$rand','$degree', '$year', '$institute' )");
		$counter = $counter +1;
}
}
	// $rs1 = mysqli_query($con, $sql1);
	echo json_encode(["success" => 1, "msg" => $counter]);



	// echo json_encode(["success" => 0, "msg" => "User Not Inserted!"]);



?>


