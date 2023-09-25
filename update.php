<?php
// Include your database connection code here

include 'connect.php';

if (isset($_POST['work']) and $_POST['work'] == 'edit') {
    $pid = $_POST['pid'];
    

    $stud =mysqli_query($conn , "SELECT * FROM `members` WHERE `mobile` = '$pid'");
    $student = mysqli_fetch_assoc($stud);
    $response = array(
        'name' => $student['name'],
        'mobile' => $student['mobile'],
        'dept' => $student['department'],
        'title' => $student['title'],
        'particapation' => $student['particapation'],
        'email' => $student['email']
    );
    
    echo json_encode($response);
    
} 
elseif (isset($_POST['work']) and $_POST['work'] == 'delete') {
    $pid = $_POST['pid'];
    

    $stud =mysqli_query($conn , "delete FROM `members` WHERE `mobile` = '$pid'");
    $student = mysqli_fetch_assoc($stud);
    $response = array(
        'success' => "Data Deleted Successfully"
    );
    
    echo json_encode($response);
    
} 
elseif (isset($_POST['work']) and $_POST['work'] == 'update') {
    $pid = $_POST['pid'];

    $stud = $conn -> prepare("UPDATE `members` SET `name`=?,`department`=?,`title`=?,`mobile`=?,`email`=?,`particapation`=? WHERE `mobile`= ?");
    $stud -> bind_param("sssssss",$_POST['name'],$_POST['department'],$_POST['title'],$_POST['mobile'],$_POST['email'],$_POST['particapation'],$_POST['pid']);
    if($stud -> execute()){
    $response = array(
        'success' => "Data Updated Successfully"
    );}
    else{
        $response = array(
        'error' => "Data Not Updated"
    );
    }
    
    echo json_encode($response);
    
} 

else {
    // Handle errors, e.g., invalid request
    echo json_encode(['error' => 'Invalid request']);
}
?>
