<?php
    require_once "header.php";

?>
<?php
	$sql = $conn->query("select count(active_user) from history where active_user = 1");
    $show = $sql->fetch_assoc();
?>
<div class="vertical-menu">
        <a href="index.php"  class="active"><i class="fas fa-home"></i>     หน้าแรก</a>
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

    <div class="main_active">
        <div class="bar">
        <i class="fas fa-users"></i> แสดงจำนวนผู้กำลังเข้าใช้งาน
        </div>
        <div class="user_active">
        <center>
                
            <i class="fas fa-user"></i> จำนวนผู้ใช้งานอยู่ <?php echo $show['count(active_user)'] ?> คน</button>
                
        </center>

        </div>
    </div>
