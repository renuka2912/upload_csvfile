<?php

$host="localhost";
$db_user="root";
$db_password="password";
$db="mydb";
$con=new mysqli($host,$db_user,$db_password,$db);
if ($con->connect_error)
{
  echo "Failed to connect to MySQL: ".$con->connect_error;
}
else{
    echo "connected to db";
}
if(isset($_POST["submit"]))
{

echo "done";
$filename=$_FILES["file"]["name"];
$file_ext=substr($filename,strrpos($filename,"."),(strlen($filename)-strrpos($filename,".")));

$time_start = microtime(true); 
if($file_ext=="csv")
{
  $file = fopen($filename, "r");
         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
         {
            $sql = "INSERT into employee(empid,empname,empphone) values('$emapData[0]','$emapData[1]','$emapData[2]')";
            mysqli_query($con, $sql);
            echo "Hi";
         }
         fclose($file);
         echo "<br>CSV File has been successfully Imported.";
}
else {
    echo "<br>Error: Please Upload only CSV File";
}
$time_end = microtime(true);
$execution_time = ($time_end - $time_start);
echo '<br><b>Total Execution Time:</b> '.($execution_time*1000).'Milliseconds';

}

?>


