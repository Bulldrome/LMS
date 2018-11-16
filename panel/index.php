<?php
die('Access Denied.');

include('header.php');

$sql = 'SELECT COUNT(id) FROM m_category WHERE status=1';
$solution = mysql_query($sql);
$solution = mysql_fetch_assoc($solution);
$solution = $solution['COUNT(id)'];

$sql = 'SELECT COUNT(id) FROM m_question WHERE status=1';
$post = mysql_query($sql);
$post = mysql_fetch_assoc($post);
$post = $post['COUNT(id)'];

$sql = 'SELECT COUNT(id) FROM m_user WHERE status=1';
$user = mysql_query($sql);
$user = mysql_fetch_assoc($user);
$user = $user['COUNT(id)'];

$sql = 'SELECT count FROM m_config WHERE id=1';
$count = mysql_query($sql);
$count = mysql_fetch_assoc($count);
$count = $count['count'];



?>

    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
<!--            <h1>欢饮使用.</h1>-->
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">
<?php if($_SESSION['usertype']==3)
{?>
            <div class="span11">
                <div class="quick-actions_homepage">
                    <ul class="quick-actions">
                        <li class="bg_lo"> <a href="category.php"> <i class="icon-th"></i>
                                <span class="label label-important"><?php echo $solution;?></span>
                                Category</a> </li>
                        <li class="bg_lg span2"> <a href="question.php"> <i class="icon-th-list"></i>
                                <span class="label label-info"><?php echo $post;?></span>
                                Subject</a> </li>
                        <li class="bg_lb"> <a href="admin.php"> <i class="icon-pencil"></i>
                                <span class="label label-success"><?php echo $user;?></span>
                                User</a> </li>
                        <li style="width: 151px;" class="bg_ls span1"> <a href="javascript:;"> <i class="icon-columns"></i>
                                <span class="label label-inverse"><?php echo $count;?></span>
                                Visit</a> </li>
                    </ul>
                </div>
            </div>
            <div class="span8">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>Server Infomation</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Apache Version</th>
                                <th>Php Version</th>
                                <th>Mysql Version</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd gradeX">
                                <td><?php echo apache_get_version();?></td>
                                <td><?php echo apache_get_version();?></td>
                                <td><?php echo apache_get_version();?></td>
                            </tr>
                            <tr>
                                <th colspan="3">
                                    Server Ip
                                </th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?php
                                        echo apache_getenv("server_addr");
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">
                                    Loaded Lodules
                                </th>
                            </tr>
                            <?php
                            $modules = apache_get_modules();
                            if(!empty($modules)){
                                ?>
                                <tr>
                                    <td>
                                        <?php echo count($modules);?> modules
                                    </td>
                                    <td colspan="2">
                                <?php
                                foreach($modules as $i=>$m){
                            ?>

                                    <?php echo $m;?>|
                            <?php
                            }
                            ?>
                                </td>
                            <?php
                                }
                            ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php }?>
        </div>
    </div>
<?php
include('footer.php');
?>