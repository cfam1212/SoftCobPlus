<?php


$fileName = $_FILES["file_input"]["name"];
$fileTmpLoc = $_FILES["file_input"]["tmp_name"];
$fileType = $_FILES["file_input"]["type"];
$fileSize = $_FILES["file_input"]["size"];
$fileErrorMsg = $_FILES["file_input"]["error"];

if(!$fileTmpLoc){
    echo "ERROR: please browse for a file before clicking";
    exit();
}

if(move_uploaded_file($fileTmpLoc,"../test_uploads/$fileName")){
    echo "$fileName upload is complete";
}else{
    echo "move_uploaded_file fuction failed";
}


?>