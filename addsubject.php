<?php
    require_once "header.php";
    
    ?>
    <div class="vertical-menu">
        <a href="index.php"  ><i class="fas fa-home"></i>     หน้าแรก</a>
        <a href="history.php" ><i class="fas fa-history"></i>     ประวัติการเข้าใช้งาน</a>
        <a href="user.php" ><i class="fas fa-user-tie"></i>     ผู้ใช้งาน</a>
        <a href="teacher.php"><i class="fas fa-chalkboard-teacher"></i>     ผู้สอน</a>
        <a href="subject.php" class="active"><i class="fas fa-book"></i>     รายวิชา</a>
    
        <a href="?logout=true"><i class="fas fa-sign-out-alt"></i>     ออกจากระบบ</a>
    </div>
    <div class="main1">
    <div class="welcome2">
       
        <h2>ระบบจัดการฐานข้อมูล Face-Detection</h2>
       
    </div>
   
   
    <div class="main2">
        <div class="bar">
        <i class="fas fa-table"></i>     ตาราง INSERT ข้อมูลรายวิชา
            
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
                                        <h3>รหัสวิชา :</h3>
                                        <input name="subid" type="text" class="form-control" required>
                                    </div>

		                            <div class="form-group col-md-6">
                                        <h3>ชื่อวิชา :</h3>
                                        <input name="subname" type="text" class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h3>ชั้นปี :</h3>
                                         <select name="subclass" class="form-control">
                                             <option>ปี 1</option>
                                             <option>ปี 2</option>
                                             <option>ปี 3</option>
                                             <option>ปี 4</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h3>สาขา :</h3>
                                        <select name="subfield" class="form-control" >
                                            <option>IT</option>
                                            <option>ITI</option>
                                            <option>IM</option>
                                            <option>TA</option>
                                            <option>TAM</option>
                                            <option>CA</option>
                                            <option>CDM</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h3>ตอนเรียน :</h3>
                                        <select name="subsection" class="form-control" >
                                            <option>ตอน 1</option>
                                            <option>ตอน 2</option>
                                            <option>ตอน 3</option>
                                            <option>ตอน 4</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h3>หน่วยกิต :</h3>
                                        <input name="subunit" type="text" class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                    <h3>อาจารย์ผู้สอน :</h3>
                            
                                    <select name="tcid" class="form-control">
                                    <option selected>เลือกผู้สอน</option>
                                    <option value="">ไม่มีผู้สอน</option>
                                    <?php
                                        $sql = mysqli_query($conn,"select * from teacher");
                                         while ($s = mysqli_fetch_array($sql)) 
                                         { 
                                             ?>
                                            <option value="<?php echo $s['tc_id'];?>"><?php echo $s['tc_name'];?></option>
                                    <?php 
                                        } 
                                    ?>
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
    $sql = $conn->query("select * from subject  where sub_id = '$_REQUEST[subid]'");
    
    if($sql->num_rows>0){
    
    //function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Duplicate ($sql);
    
    }
    else {
    
    //เพิ่มข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา
    if (empty($_REQUEST['tcid'])) {
        $tcid = "NULL";
    }
    else {
        $tcid = $_REQUEST['tcid'];
    }
    print($tcid);
    $sql = $conn->query("insert subject  set sub_id = '$_REQUEST[subid]',sub_name = '$_REQUEST[subname]',sub_class = '$_REQUEST[subclass]',sub_field = '$_REQUEST[subfield]',
    sub_section = '$_REQUEST[subsection]', sub_unit = '$_REQUEST[subunit]',tc_id = $tcid")or die (mysqli_error());
    
    //function check เพิ่มข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Insert($sql,'เพิ่มข้อมูลเรียบร้อย','subject.php');
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