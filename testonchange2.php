<?php
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
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    </head>
<body>
<div class="form-group col-md-6">
    <h3>รายวิชา :</h3>
                            
    <select id="subject" name="subject" class="form-control" onchange="jump('parent',this,0)" >
        <option selected>เลือกรายวิชา</option>
        <?php
        $sql = mysqli_query($conn,"select * from subject");
        while ($show = mysqli_fetch_array($sql)) 
        { 
        ?>
        <option value="<?=$_SERVER['PHP_SELF']."?val=$show[sub_id]"?>"><?php echo $show['sub_id']," ",$show['sub_name'];?></option>
        <?php 
        } 
        ?>
        </select>  
        </div>

        <?php
         if (isset($_GET["val"])) {
             $subject = $_GET["val"];
             $sql = mysqli_query($conn,"select * from subject where sub_id = '$subject'");
             while ($s = mysqli_fetch_array($sql))  {                     
     ?>
             <div class="form-group col-md-6">
             <h3>ชั้นปี :</h3>
             <select name="class" class="form-control">
                 <option value="<?php echo $s['sub_class'];?>"><?php echo $s['sub_class'];?></option>
             </select>
             </div>
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
       
        
               
        
        
</body>
</html>




<script type="text/javascript">
  
//<!--
function jump(targ,selObj,restore){ //v3.0
    eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
    if (restore) selObj.selectedIndex=0;
    
    }
//-->
</script>
<script>
    document.getElementById("subject").value = "<?=$_GET["subject"];?>";
</script>


