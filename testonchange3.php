<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Untitled Document</title>
    <script language="javascript" type="text/javascript">
    function doReload(catid){
        document.location = 'test2.php?catid=' + catid;

        /* But if you want to submit the form just comment above line and uncomment following lines*/
        //document.frm1.action = 'samepage.php';
        //document.frm1.method = 'post';
        //document.frm1.submit();
    }
    
    </script>
    </head>
    <body>
    <form name="frm1" id="frm1">
        <select name="catid" id="catid" onChange="doReload(this.value);">
            <option value="" selected="selected">---All Category---</option>
            <option value="CategoryOne">Category One</option>
            <option value="CategoryTwo">Category Two</option>
        </select>

        <?php
            if (isset($_GET["catid"])) {
                $catid = $_GET["catid"];       
        ?>
                <div class="form-group col-md-6">
                <h3>ชั้นปี :</h3>
                <select name="class" class="form-control">
                    <option value="<?php echo $catid ?>"><?php echo $catid ?></option>
                </select>
                </div>
        <?php
            }
        ?>
    </form>
    </body>
    </html>