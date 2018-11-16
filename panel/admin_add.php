<?php
include('header.php');
$msg = '';

if ($_POST) {
    if (empty($_POST['username']) || empty($_POST['password'])||empty($_POST['password2'])) {
        $msg = 'the field are required！';
    } else {
        if($_POST['password']!=$_POST['password2'])
        {
            $msg = 'password must equal to password2!';
        }else{
            $sql = 'SELECT * FROM dm_user WHERE username="'.$_POST['username'].'"';
            $exist = mysql_query($sql);
            if(mysql_num_rows($exist))
            {
                $msg = 'the username exists,try again!';
            }else{
                $sql = 'INSERT INTO m_user(type,created,username,password,email) VALUES('.$_POST['type'].','.time().',"' . $_POST['username'] . '","' . md5($_POST['password']) . '","'.$_POST['email'].'")';
                $res = mysql_query($sql);
                if ($res) {
                    $msg = 'Add Success!';
                    echo '<script>
                    setInterval(function(){
                        location.href = "admin.php";
                    },500);
                    </script>';
                } else {
                    $msg = 'The Server Occured An Error.';
                }
            }
        }
    }
}


?>

    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="" title="首页" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="admin_add.php" class="tip-bottom">
                    <i class="icon icon-info-sign"></i>
                    Add</a>
            </div>
            <h1>Add.</h1>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">
            <div class="row">
            <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Add</h5>
                </div>
                <div class="widget-content ">
                    <form action="" method="post" class="form-horizontal">
                        <div class="control-group">
                            <label for="inputEmail" class="">用户名</label>
                            <input type="text" name="username" id="inputEmail" class="form-control" placeholder="UserName" required autofocus>
                        </div>
                        <div class="control-group">
                        <label for="inputPassword" class="">密码</label>
                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="control-group">
                        <label for="inputPassword2" class="">确认密码</label>
                        <input type="password" name="password2" id="inputPassword2" class="form-control" placeholder="Confirm password" required>
                        </div>
                        <div class="control-group">
                            <label for="inputPassword2" class="">Type</label>
                            <select name="type" id="">
                                <option value="1">Staff</option>
                                <option value="2">Manager</option>
                                <option value="3">Administrator</option>
                            </select>
                        </div>
                        <div class="control-group">


                        <label for="">邮箱</label>
                        <input type="email" required class="form-control" placeholder="Email" name="email"/>
                        </div>
                        <div class="control-group">
                        <div class="checkbox">
                            <label style="color: #c00">
                                <?= $msg ?>
                            </label>
                        </div>
                        </div>
                        <div class="control-group">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">提交</button>
                        </div>
                            </div>
                    </form>
                </div>
            </div>

            </div>
            </div>

        </div>
    </div>

<?php
include('footer.php');
?>
<script>
    $(document).ready(function(){
        $("#Nav>li").removeClass("active");
        $("#Nav>li#User").addClass("active");
        $("#Nav>li#User>ul").slideDown();
    });
</script>