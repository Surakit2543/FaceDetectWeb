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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>จัดการระบบ Face-Detection</title>
</head>


<body>
    <header>
        <div class="main">
        <div class="logo">
            <a href="index.php"><i class="fas fa-user-tie"></i>     Admin</a>
        </div>
        <div class = "welcome">
             
        </div>
        </div>

    </header>
    
    <div class="vertical-menu">
        <a href="index.php" class="active" ><i class="fas fa-home"></i>     หน้าแรก</a>
        <a href="history.php" ><i class="fas fa-history"></i>     ประวัติการเข้าใช้งาน</a>
        <a href="user.php" ><i class="fas fa-user-tie"></i>     ผู้ใช้งาน</a>
        <a href="teacher.php"><i class="fas fa-chalkboard-teacher"></i>     ผู้สอน</a>
        <a href="subject.php"><i class="fas fa-book"></i>     รายวิชา</a>
        <a href="?logout=true"><i class="fas fa-sign-out-alt"></i>     ออกจากระบบ</a>
    </div>
    <div class="main1">
    <div class="welcome2">
       
        <h2>ระบบจัดการฐานข้อมูล Face-Detection</h2>
       
    </div>
    
   <form action="datehistory.php?date=true" method="post" role="form" class="wowload fadeInRight">
   <div class="form-group col-md-6">
   <h3>วันที่ :</h3>
    <div class="input-group input-daterange">
    <input name = "date1" type="text" class="form-control"  data-date-format="yyyy/mm/dd"  placeholder="YYY/MM/DD" >
    <div class="input-group-addon">to</div>
    <input name = "date2" type="text" class="form-control" data-date-format="yyyy/mm/dd" placeholder="YYY/MM/DD" >
   </div>
   <div class="clearfix"></div>
   <center><button type="submit" class="btn btn-success">ยืนยัน</button><button type="reset" class="btn btn-danger">ล้างข้อมูล</button></center>
   </div>
   </form>

   
</body>
</html>

<?php
   if(isset($_GET['date'])){
      $date1 = $_REQUEST['date1'];
      $date2 = $_REQUEST['date2'];

      $sql = $conn->query("select * from history where login_date(datetime) = $date1")or die (mysqli_error());

      Alert("วันที่แรก คือ $date1 วันที่สอง คือ $date2","testdatepicker.php");
   }

?>

<script type="text/javascript">
   $('.input-daterange input').each(function() {
      $(this).datepicker('clearDates');
});
</script>