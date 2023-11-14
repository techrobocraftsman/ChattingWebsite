
<?php
session_start();
$folderPath = 'upload/';

$image_parts = explode(";base64,", $_POST['image']);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$_SESSION['cropped_image'] = $image_base64;
$file = $folderPath . 'hello' . '.png';
echo json_encode(["image uploaded successfully."]);

?>