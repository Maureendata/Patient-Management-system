<?php
//Database connection
include("session.php");

$errors=[];
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    function sanitizeInput($data)
    {
        return htmlspecialchars(trim($data));
    }

    $name=$_POST["name"];
    $phone=sanitizeInput($_POST["phone"]);
    $speciality=sanitizeInput($_POST["speciality"]);
    $doctor=sanitizeInput($_POST["doctor"]);
    $date=sanitizeInput($_POST["appointment_date"]);
    $time=sanitizeInput($_POST["appointment_time"]);
    $comments=sanitizeInput($_POST["comments"]);
    $patient_id=sanitizeInput($_POST["patient_id"]);
    //Basic validation
    if (empty($name))
    {
        $errors[]='Patient name is required';
    }
   if(empty($phone))
   {
    $errors[]='Phone number is required';
   }
   if(empty($speciality))
   {

    $errors[]='Speciality is required';
   }
   if (empty($date)){
    $errors[]='Appointment date is required';
   }
   if (empty($time)){
    $errors[]='Appointment time is required';
   }
   if(empty($errors))
   {
    $stmt=$conn->prepare("INSERT INTO appointments(name,phone,
    speciality,doctor,date,time,comments,patient_id) values (?, ?, ?, ?, ?, ?, ?,? )");
    $stmt->bind_param("ssssssss",$name,$phone,$speciality,$doctor,$date,$time,$comments,$patient_id);
   $result= $stmt->execute();
   if($result)
   { 
    echo '<script>alert("Appointment added successfully!");</script>';
    echo '<script>window.location.href = "dashboard.php";</script>';   
    exit();
   
   }
   else{
    echo "Error: " . $stmt->error ?? "Unknown error";
   }
   //close the statement
   $stmt->close();
   }
   else{
    foreach($errors as $error){
        echo $error."<br>";
    }
   }
}
$conn->close();


?>

