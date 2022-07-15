<?php

//chk login 
function Chk_Login($session,$link){
if(!isset($session)){
Alert('กรุณาเข้าสู่ระบบ!',$link);
}

}

/*--------------------------------------------------------------------------*/


/*--------------------------------------------------------------------------*/


//logout
function Logout($session,$link){
unset($session);
session_destroy();
echo "<script>window.location='$link'</script>";
}

/*--------------------------------------------------------------------------*/


//Alert แจ้งเตือนต่างๆ
function Alert($text,$link){	
echo "<script language=\"javascript\">";
echo "alert('$text');";
echo "window.location='$link'";
echo "</script>";		
	}
	
/*--------------------------------------------------------------------------*/
	
//Alert แจ้งเตือนต่างๆ
function Alert_Return($text){	
echo "<script language=\"javascript\">";
echo "alert('$text');";
echo "history.back();";
echo "</script>";		
	}	
/*--------------------------------------------------------------------------*/

function Alert_Bootstarp($text){

echo '<div class="alert alert-info">
      <button type=button class=close data-dismiss=alert>&times;</button>
       <strong>'.$text.'</strong></div>';


}

/*--------------------------------------------------------------------------*/


function Alert_Bootstarp_Error($text){

echo '<div class="alert alert-danger">
      <button type=button class=close data-dismiss=alert>&times;</button>
       <strong>'.$text.'</strong></div>';


}

/*--------------------------------------------------------------------------*/


//ตรวจสอบข้อมูลของที่ select ออกมา ถ้าไม่มีข้อมูล = ค่าว่าง
function Chk_Row ($sql){
if(mysqli_num_rows($sql)==0){
echo "<center>Data not found...</center>";
}
}


/*--------------------------------------------------------------------------*/


//ตรวจสอบข้อมูลว่าถูกต้องไหม
function Chk_Correct ($sql,$text){

if(mysqli_num_rows($sql)==false){

Alert_Return($text);

}

}


/*--------------------------------------------------------------------------*/

//ตรวจสอบข้อมูลซ้ำ
function Chk_Duplicate ($sql){
	
Alert_Return('ข้อมูลซ้ำ กรุณาใส่ข้อมูลใหม่');

}


/*--------------------------------------------------------------------------*/


//ตรวจสอบเพิ่มข้อมูล
function Chk_Insert ($sql,$text,$link){
if($sql>0){
	
Alert($text,$link);

}
else {

Alert_Return('Not Complete!');

}

}


/*--------------------------------------------------------------------------*/


//ตรวจสอบการแก้ไขข้อมูล
function Chk_Update ($sql,$text,$link){

if($sql>0){
	
Alert($text,$link);

}

else {

Alert_Return('Not Complete!');

}

}


/*--------------------------------------------------------------------------*/


//ตรวจสอบลบข้อมูล
function Chk_Delete ($sql,$text){

if($sql>0){
	
Alert_Return($text);

}
else {
	
Alert_Return('Not Complete!');

}

}


/*--------------------------------------------------------------------------*/

//เพิ่มไฟล์อัพโหลด
function Upload_File ($filename,$folder){
//เก็บรูปไว้ในโฟลเดอร์ปลายทาง
move_uploaded_file($_FILES["file"]["tmp_name"],"$folder".$filename);

}




//แปลงวันที่จาก d-m-Y => Y-m-d
function cover_date($date){
    if($date!=""){
        $date=explode("-",$date);
        return $date[2]."-".$date[1]."-".$date[0];
    }
    
}

/****************************************************************************/




/*--------------------------------------------------------------------------*/


?>






