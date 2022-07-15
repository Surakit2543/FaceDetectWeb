<?php
    require_once "header.php";
?>
<div class="vertical-menu">
        <a href="index.php"  ><i class="fas fa-home"></i>     หน้าแรก</a>
        <a href="history.php" class="active"><i class="fas fa-history"></i>     ประวัติการเข้าใช้งาน</a>
        <a href="user.php" ><i class="fas fa-user-tie"></i>     ผู้ใช้งาน</a>
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
        <i class="fas fa-table"></i>     ตารางแสดงข้อมูลประวัติการใช้งาน
            
        </div>

        <?php

    ?>
    
    
        <form action="datehistory.php?date=true" method="post" role="form" class="wowload fadeInRight">
        <div class="date">
      
        <h4>ค้นหา</h4>
        <div class="input-group input-daterange" >
        <input  name = "date1" type="text" class="form-control"  data-date-format="yyyy/mm/dd"  placeholder="YYY/MM/DD" >
        <span class="input-group-addon" >to</span>
        <input name = "date2" type="text" class="form-control" data-date-format="yyyy/mm/dd" placeholder="YYY/MM/DD" >
        </div><br>
       
        <button type="submit" class="btn btn-success">ยืนยันค้นหา</button>     <button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
 
       
        </div>
    
    </form>
   
  

    <br><div class="table1"> 
    <center>
        <div class="panel">
            <a href="counthistory.php"><input name="" type="button" class="btn btn-info" value="จำนวนผู้เข้าใช้งาน"></a>
        </div>
    </center>
    
    <table class="table table-striped table-bordered table-hover" id="table_example2">
    <thead>
        <tr>
            <th width="5%"><div align="center">ลำดับ</div></th>
            <th width="auto"><div align="center">รหัสนักศึกษา</div></th>
            <th width="auto"><div align="center">ชื่อ-นามสกุล</div></th>
            <th width="auto"><div align="center">เวลาเข้าใช้งาน</div></th>
            <th width="auto"><div align="center">เวลาออกจากระบบ</div></th>
            <th width="auto"><div align="center">สถานะ</div></th>

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
    $sql = $conn->query("select * from history h INNER JOIN student s ON h.std_id=s.std_id order by h_id desc limit $start,$perpage")or die (mysqli_error());

    //หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกแสดงเพื่อจะเอาไปทำการแบ่งหน้า
    $sql2 = $conn->query("select * from history h INNER JOIN student s ON h.std_id=s.std_id order by h_id desc")or die (mysqli_error());
    $total_record = $sql2->num_rows;
    $total_page = ceil($total_record / $perpage);

    $i = 1;

    while ($show= $sql->fetch_assoc()) {

    ?>
        <tr>
        <td><div align="center"><?php echo $i++;?></div></td>
        <td><div align="center"><?php echo $show['std_id'];?></div></td>
        <td><div align="center"><?php echo $show['std_name'];?></div></td>
        <td><div align="center"><?php echo $show['login_date'];?></div></td>
        <td><div align="center"><?php echo $show['logout_date'];?></div></td>
        <?php
        if ($show['active_user'] == "0"){
        ?>
            <td><div align="center"><?php echo "ไม่ได้ใช้งาน";?></div></td>
        <?php
        }
        else {
        ?>
            <td><div align="center"><?php echo "กำลังใช้งาน";?></div></td>
        <?php
        }
        ?>
     
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
    $sql = $conn->query("delete from history where h_id = '$_REQUEST[id]'")or die (mysqli_error());

    //function delete ข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
    Chk_Delete($sql,'ลบข้อมูลเรียบร้อย','history.php');
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
<script type="text/javascript">
   $('.input-daterange input').each(function() {
      $(this).datepicker('clearDates');
});
</script>