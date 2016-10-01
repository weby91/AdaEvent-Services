<?php

 // Include confi.php
 include_once('connectToDB.php');   $dbhandle;
 
 if($_SERVER['REQUEST_METHOD'] == "POST"){
 $username = isset($_POST['username']) ? mysqli_real_escape_string($dbhandle, $_POST['username']) :  "";
 $password = isset($_POST['password']) ? mysqli_real_escape_string($dbhandle, $_POST['password']) :  "";
 $subjects = $username . ' was logged in just now';
 $result =array();
 if(!empty($username) && !empty($password)){
 $qur = mysqli_query($dbhandle,"select a.userid, a.username, a.userdetailid, a.usertypeid, a.userroleid, a.points 							   ,b.firstname, b.lastname, b.dob, b.birthplace, b.email, b.mobileno, b.address, b.zipcode, b.identityid, b.identitycode							   from user a LEFT JOIN userdetail b ON b.userdetailid = a.userdetailid WHERE a.username='$username' AND a.password = '$password' AND a.isconfirmed = 1");
					
 if(mysqli_num_rows($qur) > 0){
	 while($r = mysqli_fetch_array($qur)){
	 extract($r);
	 $result[] = array("userid" => $userid, "username" => $username, "userdetailid" => $userdetailid, "usertypeid" => $usertypeid, "userroleid" => $userroleid, "points" => $points					  ,"firstname" => $firstname, "lastname" => $lastname, "dob" => $dob, "birthplace" => $birthplace, "email" => $email, "mobileno" => $mobileno, "address" => $address, "zipcode" => $zipcode					  ,"identityid" => $identityid, "identitycode" => $identitycode); 
	 mysqli_query($dbhandle, "UPDATE user SET lastlogindate = NOW() WHERE username = '$username' AND password = '$password'");	 	 $json = array("status" => 1, "info" => $result);
	 include 'sendEmail.php';
	 }
 }
 else{
   $result[] = array("error" => "Please Confirm your account first");
	$json = array("status" => 0, "info" => $result);
 }
 }else{
 $json = array("status" => 0, "info" => "Invalid Username and Password");
 }
 }else{
 $json = array("status" => 0, "info" => "Request method not accepted");
}

 @mysqli_close($dbhandle);
 
 /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
 ?>