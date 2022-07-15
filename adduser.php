<?php
    require_once "header.php";
    
    ?>
    <div class="vertical-menu">
        <a href="index.php"  ><i class="fas fa-home"></i>     หน้าแรก</a>
        <a href="history.php" ><i class="fas fa-history"></i>     ประวัติการเข้าใช้งาน</a>
        <a href="user.php" class="active"><i class="fas fa-user-tie"></i>     ผู้ใช้งาน</a>
        <a href="teacher.php"><i class="fas fa-chalkboard-teacher"></i>     ผู้สอน</a>
        <a href="subject.php"><i class="fas fa-book"></i>     รายวิชา</a>
    
        <a href="?logout=true"><i class="fas fa-sign-out-alt"></i>     ออกจากระบบ</a>
    </div>
    <div class="main1">
    <div class="welcome2">
       
        <h2>ระบบจัดการฐานข้อมูล Face-Detection</h2>
       
    </div>
   
   
    <div class="main2">
        <div class="bar">
        <i class="fas fa-table"></i>     ตาราง INSERT ข้อมูลนักศึกษา
            
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
                                <form name="user"  method="post"  class="wowload fadeInRight" action="?insert=true">

                                <div class="form-group col-md-6">
                                    <h3>รายวิชา :</h3>
                            
                                    <select id="subject" name="subject" class="form-control" onchange="subValue(this.value)">
                                    <option selected>เลือกรายวิชา</option>
                                    <?php
                                        $sql = mysqli_query($conn,"select * from subject");
                                         while ($show = mysqli_fetch_array($sql)) 
                                         { 
                                             ?>
                                            <option id="<?php echo $show['sub_id'];?>" value="<?php echo $show['sub_id'];?>"><?php echo $show['sub_id']," ",$show['sub_name'];?></option>
                                          
                                    <?php 
                                        } 
                                    ?>
                                    </select>  
                                    </div>

                                    <?php
                                            if (isset($_GET["subid"])) {
                                            $subjectid = $_GET["subid"];
                                            $sql = mysqli_query($conn,"select * from subject where sub_id = '$subjectid'");
                                            while ($s = mysqli_fetch_array($sql))  {                     
                                    ?>
                                
                                            <div class="form-group col-md-6">
                                            <h3>ชั้นปี :</h3>
                                            <select name="class" class="form-control">
                                                <option value="<?php echo $s['sub_class'];?>"><?php echo $s['sub_class'];?></option>
                                            </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                            <h3>สาขา :</h3>
                                            <select name="field" class="form-control">
                                                <option value="<?php echo $s['sub_field'];?>"><?php echo $s['sub_field'];?></option>
                                            </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                            <h3>ตอนเรียน :</h3>
                                            <select name="section"  class="form-control">
                                                <option value="<?php echo $s['sub_section'];?>"><?php echo $s['sub_section'];?></option>
                                            </select>
                                            </div>
                                       <?php
                                            }   
                                        }  
                                    ?>
        
                                    <div class="form-group col-md-6" >
                                        <h3>รหัสนักศึกษา :</h3>
                                        <input id="stdid" name="stdid" type="text" class="form-control" required>
                                    </div>

		                            <div class="form-group col-md-6">
                                        <h3>ชื่อ :</h3>
                                        <input id="name" name="name" type="text" class="form-control" required >
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h3>อีเมล :</h3>
                                        <input id="email" name="email" type="email" class="form-control" required >
                                    </div>

                                    <div class="clearfix"></div>

                                    <button  type="submit" class="btn btn-success">ยืนยัน</button> <button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
                                 
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
    $sql = $conn->query("select * from student  where std_id = '$_REQUEST[stdid]'");
    
    if($sql->num_rows>0){
    
    //function check data ซ้ำ จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Duplicate ($sql);
    
    }
    else {
    
    //เพิ่มข้อมูลลง table ที่กำหนด โดยให้ชื่อฟิลด์ใน table ใน db = ค่าที่รับมา
   
    $sql = $conn->query("insert student  set std_id = '$_REQUEST[stdid]',std_name = '$_REQUEST[name]',std_email = '$_REQUEST[email]',std_class = '$_REQUEST[class]',std_field = '$_REQUEST[field]',
    std_section = '$_REQUEST[section]',sub_id = '$_REQUEST[subject]'")or die (mysqli_error());
    
    //function check เพิ่มข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Insert($sql,'เพิ่มข้อมูลเรียบร้อย','user.php');
    }
    
    
    }
?>
 <?php
        mysqli_close($conn);
    ?>


<script> 
    document.getElementById("subject").value = "<?=$_GET["subid"];?>";

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

<script language="javascript" type="text/javascript">
    function subValue(subid){
        document.location = 'adduser.php?subid=' + subid;
        /* But if you want to submit the form just comment above line and uncomment following lines*/
        //document.frm1.action ="?insert=true";
        //document.frm1.method = 'post';
        //document.user.submit();
    }
    
</script>
