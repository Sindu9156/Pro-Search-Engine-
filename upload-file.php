<!DOCTYPE html>
<html>
<head><meta charset="utf-8" content="width=device-width,initial-scale=1.0"><title>upload file</title></head>
<body><form action="upload-file.php" method="post" enctype="multipart/form-data">
Title<input type="text" name="topic" required>
details of doc<input type="text" name="det" required>
<input type="file" id="pdf" name="pdf" required value=""><br><br>
<input type="submit" id="b1"name="submit" value="upload">
<?php
try{
$conn=mysqli_connect("localhost","root","","searchengine");
if(isset($_POST['submit'])){

$do1=$_POST['det'];
$do2=$_POST['topic'];

$pdf=$_FILES['pdf']['name'];
$pdf_type=$_FILES['pdf']['type'];
$pdf_size=$_FILES['pdf']['size'];
$pdf_tem_loc=$_FILES['pdf']['tmp_name'];
$pdf_store="pdf/".$pdf;
move_uploaded_file($pdf_tem_loc,$pdf_store);
$sql="insert into pdf(pdf,details,topic) values('$pdf','$do1','$do2')";
$query=mysqli_query($conn,$sql);

}

}
catch(Exception $e){
    echo"$e";
}
    mysqli_close($conn);
?>
</form></body>
</html>
