<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';
$data = json_decode(file_get_contents("php://input"));
// $year = $_POST['year']; 
$qualificationarray = $data->qualification;
$removedItemArray = $data->removedItem;
$counter = 0;
// database insert SQL code
// $old = $data->old;
// $new = $data->new;
// echo json_encode(["success" => 1, "users" => $new->name]);
// echo json_encode(["success" => 1, "users2" => $obj2]);

if(!($data->fm_name == "")){
	$rs = mysqli_query($con, "UPDATE `faculty_member` SET `fm_name` = '$data->fm_name', `fm_address` ='$data->fm_address', `fm_designation` ='$data->fm_designation', `fm_salary` ='$data->fm_salary' WHERE `fm_id`= '$data->fm_id'");

	for ($x = 0; $x < sizeof($qualificationarray); $x+=1) {
		$degree = $qualificationarray[$x]->degree_tittle;
		$year = $qualificationarray[$x]->year_of_passing;
		$institute = $qualificationarray[$x]->institute_attended;
		$id = $qualificationarray[$x]->q_id;
		// if(!isset($id)){
		// 	$id = 72242;
		// }
		$rs2 = mysqli_query($con, "INSERT INTO `qualification` (`q_id`,`fm_id`,`degree_tittle`,`year_of_passing`,`institute_attended`) VALUES ('$id','$data->fm_id','$degree', '$year', '$institute' ) ON DUPLICATE KEY UPDATE  `degree_tittle`='$degree', `year_of_passing` ='$year' ,`institute_attended`='$institute'");
		// $rs2 = mysqli_query($con, "UPDATE `qualification` SET `degree_tittle`='$degree', `year_of_passing` ='$year' ,`institute_attended`='$institute' WHERE `q_id` = '$id'");
		// $counter = $counter +1;
	}
	for ($x = 0; $x < sizeof($removedItemArray); $x+=1) {
		$val = $removedItemArray[$x];
		// if(!isset($id)){
		// 	$id = 72242;
		// }
		$rs2 = mysqli_query($con, "DELETE FROM qualification WHERE q_id = '$val'");
		// $rs2 = mysqli_query($con, "UPDATE `qualification` SET `degree_tittle`='$degree', `year_of_passing` ='$year' ,`institute_attended`='$institute' WHERE `q_id` = '$id'");
		// $counter = $counter +1;
	}
}



// $sql = "UPDATE `faculty_member` SET `fm_name` = '$new->name', `fm_address` = '$new->address', `fm_designation`='$new->designation', `fm_salary`='$new->salary' WHERE `fm_id`='$old->fm_id'";

// $sql1 = "UPDATE `qualification` SET `degree_tittle`='$new->degree', `year_of_passing` ='$new->year', `institute_attended`='$new->institute'WHERE `q_id`='$old->q_id'";


// $rs = mysqli_query($con, $sql);
// $rs1 = mysqli_query($con, $sql1);

if($rs2)
{
	echo json_encode(["success" => 1, "msg" => "User Inserted."]);

}
else{
	echo json_encode(["success" => 0, "msg" => "User Not Inserted!"]);
}

?>