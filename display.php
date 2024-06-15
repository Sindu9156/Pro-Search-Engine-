<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8" content="width=device-width,initial-scale=1.0">
    <title>Document display</title>
        <style>
            embed{
                margin-left:20%;
                margin-right: 20%;
            }
            body{
                background-color:pink;
            }
        </style>
    </head>
<body>
<?php


    $conn=mysqli_connect("localhost","root","","searchengine");
    

    
    
    if(!$conn){
        die('connection failed');
    }


    
        $dd=$_GET['link'];
        $sql3="select pdf from pdf where topic=?";
      
    $stm=$conn->prepare($sql3);

        $stm->bind_param("s",$dd);
      
    
        $stm->execute();
        $res=$stm->get_result();
        
      
        while($info1=$res->fetch_array()){    
         
         
            ?>     <embed type="application/pdf" src="pdf/<?php echo $info1['pdf'];?>"width="55%" height="100%">
       
        <?php
         break;
           }
        
  
        
    
        
        mysqli_close($conn);

    
    ?>
</body></html>









































