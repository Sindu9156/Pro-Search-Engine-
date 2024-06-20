<html>
    <head>
        <title>Search page</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
    <meta charset="utf-8" content="width=device-width,initial-scale=1.0">
<style>
    #i1{
       
        border:2px solid white;
        background-color:white;
        border-radius:5px;
        align-items: center;
        margin-left:20%;
        margin-right:20%;
    }
    a{
        text-decoration: none;
        font-size: large;
        font-style:bold;
        color:blue;
    }
    a:visited{
        color:blue;
    }
    body{
        background:linear-gradient(5deg,pink 100%,white 0%);
    }
    
    #input1{
            height:150px;
            display:flex;
            align-items:center;
            justify-content:center;

          
          
         
        }
        strong{
            text-align: center;
        }
   .box{
        width:500px;
        height:45px;        
        display:flex;
        border:2px solid white;
        background-color:white;
        border-radius:50px;
        align-items: center;
  }
     .box>i{
        
        font-size:20px;
      
     } 
    input{
        flex:1;
        width:px;
        height:20px;
        padding:10px;
        border:none;
        outline:none;
        
        font-size:18px;
        
     }
  
    
      #lo{
        margin-left:180px;
        border-radius:0px;
       
      }
      strong{
        margin-left:600px;
        
      }
     


    </style>
    
    </head>
    <body>
        
   <div id="input1">        <form action="search.php" method="post" id="form1"  onsubmit="getvalue()">
  <br><br><br><br> <img id="lo"src="logo10.png" width="150px" height="80px"><br><br><div class="box">
        <i class="fa fa-search" aria-hidden="true"></i>
<input name="input1" value="" type="text" size="30" hidden-size="20" placeholder="search your context here" required>
</div></div><br><br></form>

    
    <?php

    $conn=mysqli_connect("localhost","root","","searchengine");
    
   $count=0;
    
    
    if(!$conn){
        die('connection failed');
    }
    if(isset($_POST['input1'])){
        $m=0;$count1=0;
        $inp=$_POST['input1'];
          $flag=0;   
          $flag1=0;       
        $inp=strtolower($inp);
        $arr=array(); 
        $b=0;
        $arr9="";
        $domain=array("compiler","os","react");
        $batch=array("2019","2018");
        $prolang=array("c","c++","react");
        $arr3=array();
        $arr4=array();
        $arr5=array();
        $arr2=array("compiler","engineering","os","2019","2018","c","c++","react");
        $arr=explode(" ",$inp);
      
        
        for($i=0;$i<count($arr);$i++){
            for($j=0;$j<count($arr2);$j++){
                
                if($arr[$i]==$arr2[$j]){
                    
                    $arr3[$m]=$arr2[$j];
                    $m=$m+1;
                    $count=$count+1;
                }
                else if($i+1<count($arr)){
                  $arr9.=$arr[$i].$arr[$i+1];
                    
                  if($arr2[$j]==$arr9){
                    $arr3[$m]=$arr2[$j];
                    $m=$m+1;
                    $count=$count+1;

                }
                
               }
                else{
                  
                    $arr4=str_split($arr[$i]);
               
                
                 $arr5=str_split($arr2[$j]);
                 for($o1=0;$o1<count($arr4);$o1++){
                    for($o=0;$o<count($arr5);$o++){
                        
                            if($arr4[$o1]==$arr5[$o]){
                                $l1=$o1;
                                for($o2=$o;$o2<count($arr5);$o2++){
                                      if($arr4[$l1]==$arr5[$o2] and $l1<count($arr4)){
                                       
                                        $count1=$count1+1;
                                        $l1++;
                                      }
                                }
                            }
                           
                            if($count1==count($arr5)&&$count1!=1){
                               //echo $count1;
                                 $flag1=1;
                                    $arr3[$m]=$arr2[$j];
                                    $m=$m+1;
                                    $count=$count+1;
                                    
                                   
                             }
                             $count1=0;
                             if($flag1==1)
                                break;
                            
                    }


                    }
                  }
                    
                
              }
            }
    
            $ass_arr=array();
            $sql="select pdf from pdf";
            $stmt=$conn->prepare($sql);
   
            $stmt->execute();
            $result=$stmt->get_result();
            
            $text=$result->fetch_array();
            $count_pdf=0;
            while( $text=$result->fetch_array()){            
                    $sql1="select keyword from pdf where pdf='$text[0]'";
                    $stmt1=$conn->prepare($sql1);
                    $stmt1->execute();
                    $result1=$stmt1->get_result();
                    $word=$result1->fetch_array();
                    $string=explode(",",$word[0]);
                   
                 
                    for($g=0;$g<count($arr3);$g++){             
                       $index=array_search($arr3[$g],$string);
                       
                    if($index!=false){
                        $count_pdf=$string[$index+1];
                        if(array_key_exists($text[0],$ass_arr)){
                               $ass_arr[$text[0]]+=$count_pdf;
                        }
                        else{
                            $ass_arr[$text[0]]=$count_pdf;
                        }
                       
                    }
                   
                
                    
                }
               
            }
           
            
        
          /*  for($g=0;$g<count($arr3);$g++){
               for($i=0;$i<count($word_array);$i++){
                if(in_array($arr3[$g],$word_array[$i])){

                }
               }


            }
                 
                include 'vendor/autoload.php';
                $parser=new \Smalot\PdfParser\Parser();
                
                $txt=$text['pdf'];
                $file="pdf/$txt";
                $pdf=$parser->parseFile($file);
                $textContent=$pdf->getText();
                for($e=0;$e<count($arr3);$e++){
                    $count_pdf=0;
                if(strpos($textContent,$arr3[$e])!=false){
                    $count_pdf+=substr_count($textContent,$arr3[$e]);
                }
                }
                if($count_pdf!=0){
                if(array_key_exists($txt,$ass_arr)){
                    if($ass_arr[$txt]<$count_pdf)
                       $ass_arr[$txt]=$count_pdf;
                }
                else{
                    $ass_arr[$txt]=$count_pdf;
                }
            }
               
            }
            */
            arsort($ass_arr);
        
            
            if(!empty($ass_arr)){
             
            
                foreach($ass_arr as $x=>$y){
                   echo $y;
               $sql="select details from pdf where pdf=?";
            $sql1="select title from pdf where pdf=?";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("s",$x);
            $stmt->execute();
            $result=$stmt->get_result();
            $stmt1=$conn->prepare($sql1);
            $stmt1->bind_param("s",$x);
            $stmt1->execute();
            $result1=$stmt1->get_result();

   while($info=$result->fetch_array() and $topic=$result1->fetch_array()){     
          
          ?>
    
            <div id="i1"width="40px" height="20px" >
            <a href="display.php?link=<?php foreach($topic as $t){
                    echo $t;
                    break;}?>"><?php foreach($topic as $t){
                    echo $t;
                    break;}?></a><br><br>
                <?php 
        
        foreach($info as $in){
            echo $in;
            break;
        }
    ?>
        </div><br>
        </body></html> <?php
            }
        }     
        }
        else{
            ?>
             <strong>No results found</strong>
             <?php
        }
    
       
 

       
        


   
        mysqli_close($conn);

    }
    ?>
