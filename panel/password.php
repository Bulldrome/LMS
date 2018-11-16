<?php
include('header.php');
if($_POST)
{
    $sql = 'UPDATE m_user SET password="'.md5($_POST['pwd']).'" WHERE id='.$_SESSION['userid'];
    //echo $sql;exit;
    mysql_query($sql);
    echo '<script>
    location.href = "quit.php";
    </script>';
}

?>

    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="" title="首页" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="password.php" class="tip-bottom">
                    <i class="icon icon-info-sign"></i>
                    Password</a>
            </div>
            <h1>Password.</h1>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">
            <div class="row-fluid">
            <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Password</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="" method="post" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">新密码 :</label>
                            <div class="controls">
                                <input name="pwd" type="password" class="span11" placeholder="" value="<?php echo $user['username'];?>">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">更新</button>
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