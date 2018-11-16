<?php
include('header.php');
$sql = 'SELECT * FROM m_user WHERE status=1';
$res = mysql_query($sql);
$arr = array();
$i = 0;
while ($row = mysql_fetch_assoc($res)) {
    $arr[$i] = $row;
    $i++;
}

if ($_GET) {
    if (isset($_GET['a'])) {
        $act = $_GET['a'];
        if ($act == 'del') {
            $sql = 'UPDATE m_user SET status=0 WHERE id=' . $_GET['id'];
            mysql_query($sql);
            echo '<script>
            location.href = "admin.php";
            </script>';
        }
    }
}
?>

    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="" title="首页" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="admin.php" title="Feed List" class="tip-bottom"><i class="icon-comment"></i> List</a>
            </div>
            <h1>List.</h1>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">
            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>List</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>用户名</th>
                                <th>邮箱</th>
                                <th>类型</th>
                                <th>注册时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($arr)) {
                                foreach ($arr as $i => $a) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i + 1; ?></td>
                                        <td><?php echo $a['username'] ?></td>
                                        <td><?php echo $a['email'] ?></td>
                                        <td>
                                            <?php
                                                if($a['type']==1) echo 'Staff';
                                            if($a['type']==2) echo 'Manager';
                                            if($a['type']==3) echo 'Administrator';
                                            ?>
                                        </td>
                                        <td><?php echo date('Y-m-d H:i:s',$a['created']); ?></td>
                                        <td>
<?php
if($a['username']!='admin'){
?>
                                                              [<a href="admin.php?a=del&id=<?php echo $a['id']; ?>">
                                                    <i class="icon icon-trash"></i>
                                                    Delete</a>]
    <?php }?>

                                        </td>
                                    </tr>
                                <?php
                                }
                            }else{
                            ?>
                                <tr>
                                    <td colspan="6">Empty.</td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
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