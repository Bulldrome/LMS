<?php
require_once '../include/config.inc.php';

$msg = '';
$xmsg = '';
if (isset($_SESSION['username'])) {
    echo '<script>
    location.href = "index.php" +
     "";
    </script>';
} else {
    if ($_POST) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $msg = 'UserName And Password Is Required.';
        } else {
            $sql = 'SELECT * FROM c_user WHERE status=1 AND username="' . $_POST['username'] . '" AND password="' . $_POST['password']. '"';
            //echo $sql;
            $res = mysql_query($sql);
            if (mysql_num_rows($res)) {
                $row = mysql_fetch_assoc($res);
                $_SESSION['username'] = $row['username'];
                $_SESSION['userid'] = $row['id'];
                $_SESSION['usertype'] = $row['type'];

                $sql = 'UPDATE m_config SET count=count+1';
               mysql_query($sql);

                echo '<script>
                location.href = "index.php";
                </script>';
            } else {
                $msg = 'UserName Or Password ERR,Try Again！';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <title>Onlie Exam</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="../css/matrix-login.css" />
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<!--		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>-->

    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="sign.php" method="post">
				 <div class="control-group normal_text"> <h3><img src="../img/logo_login.png" alt="Logo" />
                         Onlie Exam</h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"></i></span><input type="text" name="username" required id="UserName" placeholder="UserName" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" id="Password" required placeholder="password" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <label for="" style="color: #c00" id="Msg">
                            <?php echo $msg;?>
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-right"><a type="submit" href="javascript:;" class="btn btn-success" id="LoginBtn" /> Login</a></span>
                </div>
            </form>
        </div>
        
        <script src="../js/jquery.min.js"></script>
        <script src="../js/matrix.login.js"></script>

        <script>

            $(document).ready(function(){
                $("#LoginBtn").click(function(){

                    var userName = $("#UserName").val();
                    var password = $("#Password").val();
                    if(userName==""||password=="")
                    {
                        $("#Msg").html("All Field Are Required.");
                        return false;
                    }

                    $("#loginform").submit();

                });

            });
        </script>

    </body>

</html>
