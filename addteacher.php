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
        <i class="fas fa-table"></i>     ตาราง INSERT ข้อมูลผู้สอน
            
        </div>

        <?php


    ?>
    <br><div class="table1">
     <!--Simple table example -->
     <div class="panel panel-primary">
            <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> เพิ่มข้อมูล

                        </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="?insert=true" method="post" role="form" class="wowload fadeInRight">

                                    <div class="form-group col-md-6">
                                        <h3>รหัสผู้สอน :</h3>
                                        <input name="tcid" type="text" class="form-control" required>
                                    </div>

		                            <div class="form-group col-md-6">
                                        <h3>ชื่อผู้สอน :</h3>
                                        <input name="tcname" type="text" class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h3>อีเมล :</h3>
                                        <input name="tcemail" type="text" class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h3>รหัสผ่าน :</h3>
                                        <input name="tcpass" type="text" class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                    <h3>รายวิชา :</h3>
                            
                                    <select name="subid" class="form-control">
                                    <option selected>เลือกรายวิชา</option>
                                    <option value="">ไม่มีรายวิชา</option>
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
                                        <select name="tcpermiss" class="form-control" >
                                            <option value="0">จำกัดสิทธิ์เข้าใช้งาน</option>
                                            <option value="1">มีสิทธิ์เข้าใช้งาน</option>
                                           
                                        </select>
                                    </div>

                                    <div class="clearfix"></div>

                                    <button type="submit" class="btn btn-success">ยืนยัน</button> <button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
                                </form>    

                                </div>

                            </div>
							
                            <!-- /.row -->
    </div>
    </div>
    </div>

</body>
</html>
   <?php
//insert data
if(isset($_GET['insert'])){

    //check data ซ้ำ โดย check ตามชื่อฟิลด์ที่กำหนด ถ้า ซ้ำกันจะไม่สามารถเพิ่มข้อมูลได้
    $sql = $conn->query("select * from teacher where tc_id = '$_REQUEST[tcid]'");
    
    if($sql->num_rows>0){
    
    //function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Duplicate ($sql);
    
    }
    else {
    
    //เพิ่มข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา
    if (empty($_REQUEST['subid'])) {
        $subid = "NULL";
    }
    else {
        $subid = $_REQUEST['subid'];
    }
    $sql = $conn->query("insert teacher set tc_id = '$_REQUEST[tcid]', tc_name = '$_REQUEST[tcname]',tc_email = '$_REQUEST[tcemail]',
    tc_pass = '$_REQUEST[tcpass]',tc_permiss = '$_REQUEST[tcpermiss]'")or die (mysqli_error());

    $sql = $conn->query("update subject set tc_id = '$_REQUEST[tcid]' where sub_id = $subid")or die (mysqli_error());
    
    //function check เพิ่มข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Insert($sql,'เพิ่มข้อมูลเรียบร้อย','teacher.php');
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