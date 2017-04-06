<?php

 $connect = mysqli_connect("localhost", "vishnum1998","zrrJ8zNEdpuTwuty","zailet");
    
     $output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "SELECT id FROM topics_english WHERE intrest LIKE '%".$search."%'";
}
else
{
 $query = "
  SELECT id FROM topics_english
 ";
}
$result = mysqli_query($connect, $query);
//print_r($result);
if(mysqli_num_rows($result) > 0)
{   //data from topics english
    while($row = mysqli_fetch_array($result))
 {      $query1="SELECT post_id FROM topics_map WHERE topic_id=". $row["id"];
        //echo $query1;
        $result1 = mysqli_query($connect, $query1);
       // var_dump($result1);
        if(mysqli_num_rows($result1) > 0)
        {     //data table topics_map details
              while($row = mysqli_fetch_array($result1))
              { 
                 $query2="SELECT title FROM posts WHERE id=".$row["post_id"];
                 //echo $query2;
                 $result2=mysqli_query($connect,$query2);
                 //var_dump($result2);
                 //echo "<br><br>";
                 if(mysqli_num_rows($result2) > 0)
                {  
                    while($row = mysqli_fetch_array($result2))
                    { //echo $row["title"];
                    $output.="<li><a>".$row["title"]."</a></li>";
                    //$output.=$row["title"]  ; 
                    }
                
                }
                else
                {
                   // echo "data not found in posts";
                }
                 
                 
                 
                 // $output .= "post id = " .$row["post_id"];
              }
            
         //echo $output;
        }
            else
        {
         //echo 'Data Not Found in topics_map';
        }
 }
 
 
 echo $output;
}
else
{
// echo 'Data Not Found in topics_english';
}
//echo $query;

    
    ?>