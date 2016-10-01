<?php // Include confi.php
include 'connectToDB.php';

$dbhandle;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname   = isset($_POST['firstname']) ? mysqli_real_escape_string($dbhandle, $_POST['firstname']) : "";
    $email        = isset($_POST['email']) ? mysqli_real_escape_string($dbhandle, $_POST['email']) : "";
    $password  = isset($_POST['password']) ? mysqli_real_escape_string($dbhandle, $_POST['password']) : "";
	$mobileno  = isset($_POST['mobileno']) ? mysqli_real_escape_string($dbhandle, $_POST['mobileno']) : "";
	$dob = isset($_POST['dob']) ? mysqli_real_escape_string($dbhandle, $_POST['dob']) : "";
	$gender = isset($_POST['gender']) ? mysqli_real_escape_string($dbhandle, $_POST['gender']) : "";
	$registeredfrom = isset($_POST['registeredfrom']) ? mysqli_real_escape_string($dbhandle, $_POST['registeredfrom']) : "";
	$mobiletype = isset($_POST['mobiletype']) ? mysqli_real_escape_string($dbhandle, $_POST['mobiletype']) : "";
	$subjects = $firstname . ' just registered';
    $dd              = date_create($dob);
    $dob         = date_format($dd, "Y-m-d");
    $insertToUserDetail             = mysqli_query($dbhandle, "INSERT INTO userdetail
															   (firstname, dob, email, mobileno, gender)
															    VALUES
															   ('$firstname', '$dob', '$email', '$mobileno', '$gender')") ;
	
	if($insertToUserDetail){	
		$userdetailid = mysqli_insert_id($dbhandle);
				
		if($userdetailid != 0){
			$insertToUser = mysqli_query($dbhandle, "INSERT INTO user
											   (password, userdetailid, registrationdate, registeredfrom, mobiletype)
												VALUES
											   ('$password', $userdetailid, NOW(), '$registeredfrom', '$mobiletype')") ;
			
			if($insertToUser){
				$json = array(
                "status" => 1,
                "info" => "Successfully Registered!"
				);
				include 'sendEmail.php';
			}else{
				$json = array(
						"status" => 0,
						"info" => "Registration Failed!"
						);
			}
	}else{
		$json = array(
                "status" => 0,
                "info" => "Registration Failed!"
				);
	}
	
    
    }
} else {
    $json = array(
        "status" => 0,
        "msg" => "Request method not accepted"
    );
}
@mysqli_close($dbhandle);
/* Output header */
echo json_encode($json);


?>