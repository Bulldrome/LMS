<?php
include('header.php');

$sql = 'SELECT * FROM m_user WHERE id='.$_SESSION['userid'];
$res = mysql_query($sql);
$user = mysql_fetch_assoc($res);

if($_POST)
{
    $sql = 'UPDATE m_user SET email="'.$_POST['email'].'" WHERE id='.$_SESSION['userid'];
    mysql_query($sql);
    echo '<script>
    location.href = "profile.php";
    </script>';
}

?>

    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="首页" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="profile.php" class="tip-bottom">
                    <i class="icon icon-info-sign"></i>
                    Profile</a>
            </div>
            <h1>Profile.</h1>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">
            <div class="row-fluid">
            <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Profile</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="" method="post" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">用户名 :</label>
                            <div class="controls">
                                <input type="text" readonly class="span11" placeholder="" value="<?php echo $user['username'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">邮箱 :</label>
                            <div class="controls">
                                <input type="text" name="email" class="span11" value="<?php echo $user['email'];?>" placeholder="Email">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">注册时间</label>
                            <div class="controls">
                                <input type="text" readonly class="span11" placeholder="Created" value="<?php echo date('Y-m-d',$user['created']);?>">
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