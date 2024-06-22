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
$ass_arr=array();
$sql="select pdf from pdf where pdf='$pdf'";
$stmt=$conn->prepare($sql);

$stmt->execute();
$result=$stmt->get_result();

while($text=$result->fetch_array()){


     
    include 'vendor/autoload.php';
    $parser=new \Smalot\PdfParser\Parser();
    
    $txt=$text['pdf'];
    $file="pdf/$txt";
    $pdf1=$parser->parseFile($file);
    $textContent=$pdf1->getText();
    $textContent=strtolower($textContent);
    $words_count=str_word_count($textContent,1);
    $index=array_search("abstract",$words_count);
    $details=array_slice($words_count,$index+1,10);
    $title=array_slice($words_count,0,5);
    $final_words=array_diff($words_count,$stop_words);
    $frequencyofword=array_count_values($final_words);
    $top_key_words=array_slice($frequencyofword,0,10);
   
    
   
}




$string='';
foreach($top_key_words as $key=>$val){
    $string.=$key;
    $string.=',';
    $string.=$val;
    $string.=',';
}
$string2='';
foreach($details as $val){
    $string2.=$val;
    $string2.=' ';
}
$string1='';
foreach($title as $val){
    $string1.=$val;
    $string1.=' ';
}

$sql1="update pdf set keyword='$string' where pdf='$pdf'";
$sql2="update pdf set details='$string2' where pdf='$pdf'";
$sql3="update pdf set title='$string1' where pdf='$pdf'";

$query=mysqli_query($conn,$sql1);
$query=mysqli_query($conn,$sql2);
$query=mysqli_query($conn,$sql3);
}




catch(Exception $e){
    echo"$e";
}
    mysqli_close($conn);
?>
</form></body>
</html>
