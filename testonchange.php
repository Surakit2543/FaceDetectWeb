<?php
require_once "function.php";
 
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "facedetection";
$conn = mysqli_connect( $hostname, $username, $password );
if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ mysqli ได้" );
mysqli_select_db ( $conn,$dbname  )or die ( "ไม่สามารถเลือกฐานข้อมูล GameStore ได้" );
mysqli_query($conn,"SET character_set_results=utf8");
mysqli_query($conn,"SET character_set_client=utf8");
mysqli_query($conn,"SET character_set_connection=utf8");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> new document </title>
</head>

<body>
<form name="test" method="POST" onchange="document.test.submit();">
	<select id="cars" name="cars" >
		<option value="volvo">Volvo</option>
		<option value="saab">Saab</option>
		<option value="fiat">Fiat</option>
		<option value="audi">Audi</option>
	</select>
    <button type="submit" class="btn btn-success">ยืนยัน</button>


<div class="form-group col-md-6">
    <h3>รายวิชา :</h3>                   
        <select id="subject" name="subject" onchange="document.test.submit();">
            <option >เลือกรายวิชา</option>
            <?php
                $sql = mysqli_query($conn,"select * from subject ");
                while ($r = mysqli_fetch_array($sql)) 
                { 
            ?>
                <option value="<?php echo $r['sub_id'];?>"><?php echo $r['sub_id']," ",$r['sub_name'];?></option>
            <?php 
                } 
            ?>
        </select>
    </div>
   
    <div class="form-group col-md-6">
        <h3>ชั้นปี :</h3>
        <select id="class" name="class" >
            <?php
                $sql = mysqli_query($conn,"select * from subject where sub_id = '$_REQUEST[subject]'");
                while ($s = mysqli_fetch_array($sql)) 
                { 
            ?>
            <option><?php echo $s['sub_class'];?></option>
            <?php 
                } 
            ?>
        </select>
    </div>
    </form>
</body>
</html>
<?php
if(isset($_GET['insert'])){
    echo("TEST")
?>
<?php
}
?>
<script type="text/javascript">

document.getElementById("cars").value = "<?=$_POST["cars"];?>";
document.getElementById("subject").value = "<?=$_POST["subject"];?>";

//-->
</script>