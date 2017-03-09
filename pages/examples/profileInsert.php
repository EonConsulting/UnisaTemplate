<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "adminlte");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$name = mysqli_real_escape_string($link, $_REQUEST['firstname']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$school = mysqli_real_escape_string($link, $_REQUEST['school']);

$programme = mysqli_real_escape_string($link, $_REQUEST['programme']);
$location = mysqli_real_escape_string($link, $_REQUEST['location']);
$notes = mysqli_real_escape_string($link, $_REQUEST['notes']);

// $profile_pic = mysqli_real_escape_string($link, $_REQUEST['profilepic']);
 
// attempt insert query execution


if (!empty($_FILES["profilepic"]["name"])) {

    $file_name=$_FILES["profilepic"]["name"];
    $temp_name=$_FILES["profilepic"]["tmp_name"];
    $imgtype=$_FILES["profilepic"]["type"];
   
$imagename=date("d-m-Y")."-".time().$_FILES["profilepic"]["name"];
    $target_path = "img/".$imagename;

if(move_uploaded_file($temp_name, $target_path)) {




$sql = "INSERT INTO profile (name, email, school, programme, location, notes, profile_pic) VALUES ('$name', '$email', '$school', '$programme', '$location', '$notes', '$target_path')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

}else{
   exit("Error While uploading image on the server");
}
}

header('Location: profile.html');

// close connection
mysqli_close($link);
?>