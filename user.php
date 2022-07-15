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
        <i class="fas fa-table"></i>     ตารางแสดงข้อมูลนักศึกษา
            
        </div>

        <?php

    ?>
    <br><div class="table1">
    <center><div class="panel"><a href="adduser.php"><input name="" type="button" class="btn btn-success" value="เพิ่มข้อมูลนักศึกษา"></a></div></center>
    <table class="table table-striped table-bordered table-hover" id="table_example2">
    <thead>
        <tr>
            <th width="5%"><div align="center">ลำดับ</div></th>
            <th width="auto"><div align="center">รหัสนักศึกษา</div></th>
            <th width="auto"><div align="center">ชื่อ-นามสกุล</div></th>
            <th width="auto"><div align="center">อีเมล</div></th>
            <th width="auto"><div align="center">ชั้นปี</div></th>
            <th width="auto"><div align="center">สาขา</div></th>
            <th width="auto"><div align="center">ตอนเรียน</div></th>
            <th width="auto"><div align="center">รายวิชา</div></th>
            <th width="15%"><div align="center">จัดการ</div></th>

        </tr>
    </thead>
    <tbody>
    <?php

    //โค๊ดแบ่งหน้า
    $perpage = 10;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $start = ($page - 1) * $perpage;

    //แสดงข้อมูลตามเงื่อนไข และ มีการแบ่งหน้ารายการ
    $sql = $conn->query("select * from student INNER JOIN subject ON student.sub_id=subject.sub_id order by std_id desc limit $start,$perpage")or die (mysqli_error());

    //หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกแสดงเพื่อจะเอาไปทำการแบ่งหน้า
    $sql2 = $conn->query("select * from student INNER JOIN subject ON student.sub_id=subject.sub_id order by std_id desc")or die (mysqli_error());
    $total_record = $sql2->num_rows;
    $total_page = ceil($total_record / $perpage);

    $i = 1;

    while ($show= $sql->fetch_assoc()) {

    ?>
        <tr>
        <td><div align="center"><?php echo $i++;?></div></td>
        <td><div align="center"><?php echo $show['std_id'];?></div></td>
        <td><div align="center"><?php echo $show['std_name'];?></div></td>
        <td><div align="center"><?php echo $show['std_email'];?></div></td>
        <td><div align="center"><?php echo $show['std_class'];?></div></td>
        <td><div align="center"><?php echo $show['std_field'];?></div></td>
        <td><div align="center"><?php echo $show['std_section'];?></div></td>
        <td><div align="center"><?php echo $show['sub_name'];?></div></td>
        <td>
            <div align="center"><a href="edituser.php?&id=<?php echo $show['std_id'];?>"><input name="" type="button" class="btn btn-primary" value="Edit"></a>&nbsp;
            <a href="?delete=true&id=<?php echo $show['std_id'];?>"><input name="" type="button" class="btn btn-danger" value="Delete"></a></div>
        </td>
    </tr>
    <?php }
    ?>

        <!-- ส่วนของการแสดงเลขแบ่งหน้า ถ้าไม่พบข้อมูลเลยจะขึ้นว่า Data Not Found แต่ถ้ามีข้อมูลจะขึ้นเลขแบ่งหน้า-->
        <tr>
        <td colspan="10"><div align="center"><?php if($sql->num_rows==0){Chk_Row($sql);}else {?><nav>
        <ul class="pagination">
        <li>
        <a href="?page=1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span> </a> </li>
        <?php for($i=1;$i<=$total_page;$i++){ ?>
        <li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li>
        <a href="?page=<?php echo $total_page;?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span> </a> </li>
        </ul>
        </nav><?php } ?></div></td>
        </tr>
    </tbody>
    </table>
    </div>
    </div>
    </div>
</body>
</html>

<?php
    //delete data
    if(isset($_GET['delete'])){
    //ลบข้อมูลใน table ที่กำหนด ตาม id ของรายการนั้น
    $sql = $conn->query("delete from student where std_id = '$_REQUEST[id]'")or die (mysqli_error());

    //function delete ข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Delete($sql,'ลบข้อมูลเรียบร้อย','user.php');
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