<?php
    require_once "header.php";
    
    ?>
    <div class="vertical-menu">
        <a href="index.php"  ><i class="fas fa-home"></i>     หน้าแรก</a>
        <a href="history.php" ><i class="fas fa-history"></i>     ประวัติการเข้าใช้งาน</a>
        <a href="user.php" ><i class="fas fa-user-tie"></i>     ผู้ใช้งาน</a>
        <a href="teacher.php" class="active"><i class="fas fa-chalkboard-teacher"></i>     ผู้สอน</a>
        <a href="subject.php"><i class="fas fa-book"></i>     รายวิชา</a>
    
        <a href="?logout=true"><i class="fas fa-sign-out-alt"></i>     ออกจากระบบ</a>
    </div>
    <div class="main1">
    <div class="welcome2">
       
        <h2>ระบบจัดการฐานข้อมูล Face-Detection</h2>
       
    </div>
   
   
    <div class="main2">
        <div class="bar">
        <i class="fas fa-table"></i>     ตาราง EDIT ข้อมูลผู้สอน
            
        </div>

        <?php


    ?>
    <br><div class="table1">
    <div class="row">
                <div class="col-lg-12">

                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> แก้ไขข้อมูล

                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="?update=true&id=<?php echo $_REQUEST['id'];?>" method="post" role="form" class="wowload fadeInRight">
      <?php
	$sql = $conn->query("select * from teacher INNER JOIN subject ON teacher.tc_id = subject.tc_id where teacher.tc_id = '$_REQUEST[id]'");
    $show = $sql->fetch_assoc();
		?>

          <div class="form-group col-md-6">
            <h3>รหัสผู้สอน :</h3>
            <input name="tcid" type="text" class="form-control" required value="<?php echo $show['tc_id'];?>">
          </div>

		      <div class="form-group col-md-6">
            <h3>ชื่อผู้สอน :</h3>
            <input name="tcname" type="text" class="form-control" required value="<?php echo $show['tc_name'];?>">
          </div>

          <div class="form-group col-md-6">
            <h3>อีเมล :</h3>
            <input name="tcemail" type="text" class="form-control" required value="<?php echo $show['tc_email'];?>">
          </div>

          <div class="form-group col-md-6">
            <h3>รหัสผ่าน :</h3>
            <input name="tcpass" type="text" class="form-control" required value="<?php echo $show['tc_pass'];?>">
          </div>

          <div class="form-group col-md-6">
            <h3>รายวิชา :</h3>         
            <select name="subid" class="form-control">
                <option selected value="<?php echo $show['sub_id'];?>"><?php echo $show['sub_id']," ",$show['sub_name'];?></option>
        <?php
                $sql = mysqli_query($conn,"select * from subject");
                while ($s = mysqli_fetch_array($sql)) 
                { 
        ?>
                    <option value="<?php echo $s['sub_id'];?>"><?php echo $s['sub_id']," ",$s['sub_name'];?></option>
        <?php 
                } 
        ?>
            </select>
            </div>

          <div class="form-group col-md-6">
            <h3>สิทธิ์การใช้งาน :</h3>
            <select name="tcpermiss" class="form-control">
            <?php
                if ($show['tc_permiss'] == "0"){  
            ?>
                    <option value="0">จำกัดสิทธิ์เข้าใช้งาน</option>
                    <option value="1">มีสิทธิ์เข้าใช้งาน</option>
            <?php
                }
                else{
            ?>
                    <option value="1">มีสิทธิ์เข้าใช้งาน</option>
                    <option value="0">จำกัดสิทธิ์เข้าใช้งาน</option>
            <?php
            }
            ?>
            </select>
           
            
          </div>
        


          <div class="clearfix"></div>
  
        <button type="submit" class="btn btn-primary">ยืนยัน</button> <button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
    </form>    
                                </div>

                            </div>

	
    </div>
   
    </div>
    </div>

</body>
</html>
   <?php

//update data
if(isset($_GET['update'])){

    //check data ซ้ำ โดย check ตามชื่อฟิลด์ที่กำหนด ถ้า ซ้ำกันจะไม่สามารถแก้ไขข้อมูลได้
    $sql = $conn->query("select * from teacher INNER JOIN subject ON teacher.tc_id = subject.tc_id where teacher.tc_id = '$_REQUEST[tcid]' && teacher.tc_id != '$_REQUEST[id]'")or die (mysqli_error());
    if($sql->num_rows>0){
    
    //function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Duplicate ($sql);
    
    }
    else {
    //แก้ไขข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา โดยข้อมูลที่แก้จะเปลี่ยนแปลงตาม id ของ รายการนั้น
    $sql = mysqli_query($conn,"update teacher INNER JOIN subject ON teacher.tc_id = subject.tc_id set teacher.tc_id = '$_REQUEST[tcid]',
    tc_name = '$_REQUEST[tcname]',tc_email = '$_REQUEST[tcemail]',tc_pass = '$_REQUEST[tcpass]',
    tc_permiss = '$_REQUEST[tcpermiss]' where teacher.tc_id = '$_REQUEST[tcid]'")or die (mysqli_error());

    $sql = $conn->query("update subject set tc_id = null where tc_id = '$_REQUEST[tcid]'")or die (mysqli_error());
    $sql = $conn->query("update subject set tc_id = '$_REQUEST[tcid]' where sub_id = '$_REQUEST[subid]'")or die (mysqli_error());
    
    
    //function check แก้ไขข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Update($sql,'แก้ไขข้อมูลเรียบร้อย','teacher.php');
    }
    
    
    }
?>
 <?php
        mysqli_close($conn);
    ?>


<script>
    var dropdown = document.getElementsByClassName("dropdown");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>