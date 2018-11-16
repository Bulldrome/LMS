<?php
include('header.php');

$sql = 'SELECT * FROM m_config WHERE id=1';
$res = mysql_query($sql);
$config = mysql_fetch_assoc($res);

//更新系统信息
if ($_POST) {
    $title = post('title');
    $keywords = post('keywords');
    $description = post('description');
    $face = post('facebook');
    $email = post('email');
    $tel = post('telephone');
    $copy = post('copy');
    $address = post('address');
    $master = post('master');
    $url = post('url');
    $current_exam = $_POST['exam'];

    $sql = 'UPDATE m_config SET current_exam="'.$current_exam.'", master="'.$master.'", facebook="'.$face.'",title="' . $title . '",keywords="' . $keywords . '",description="' . $description . '",email="' . $email . '",tel="' . $tel . '",copyright="' . $copy . '",address="' . $address . '",url="' . $url . '" WHERE id=1';
    mysql_query($sql);
    echo '<script>
    location.href = "setting.php";
    </script>';
}
$sql = 'SELECT * FROM m_exam WHERE status=1';
$res = mysql_query($sql);
$data = array();
while ($t = mysql_fetch_assoc($res)) {
    $data[] = $t;
}



?>

    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="" title="首页" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="setting.php" class="tip-bottom">
                    <i class="icon icon-info-sign"></i>
                    Setting</a>
            </div>
            <h1>Setting.</h1>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">
            <div class="row-fluid">
            <div class="span10">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Setting</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="" method="post" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">Current Exam :</label>
                            <div class="controls">
                                <select name="exam" id="">

                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $i => $u):
                                            ?>
                                            <option <?php if($u['id']==$config['current_exam']) echo 'selected';?> value="<?php echo $u['id']?>"><?php echo $u['title']?></option>
                                        <?php endforeach;}?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">网站名称 :</label>
                            <div class="controls">
                                <input name="title" type="text" class="span11" placeholder="site title" value="<?php echo $config['title'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">管理员 :</label>
                            <div class="controls">
                                <input name="master" type="text" class="span11" placeholder="Manager" value="<?php echo $config['master'];?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">关键字 :</label>
                            <div class="controls">
                                <input type="text" name="keywords" class="span11" value="<?php echo $config['keywords'];?>" placeholder="keywords">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">描述 :</label>
                            <div class="controls">
                                <input type="text" name="description" class="span11" value="<?php echo $config['description'];?>" placeholder="description">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">版权 :</label>
                            <div class="controls">
                                <input type="text" name="copy" class="span11" value="<?php echo $config['copyright'];?>" placeholder="copy rights">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">地址 :</label>
                            <div class="controls">
                                <input type="text" name="address" class="span11" value="<?php echo $config['address'];?>" placeholder="address">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Facebook :</label>
                            <div class="controls">
                                <input type="text" name="facebook" class="span11" value="<?php echo $config['facebook'];?>" placeholder="facebook">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">电话 :</label>
                            <div class="controls">
                                <input type="text" name="telephone" class="span11" value="<?php echo $config['tel'];?>" placeholder="tel">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">邮箱 :</label>
                            <div class="controls">
                                <input type="text" name="email" class="span11" value="<?php echo $config['email'];?>" placeholder="email">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">网址 :</label>
                            <div class="controls">
                                <input type="text" name="url" class="span11" value="<?php echo $config['url'];?>" placeholder="url">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">访问量 :</label>
                            <div class="controls">
                                <input type="number" readonly class="span11" value="<?php echo $config['count'];?>" placeholder="visit">
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