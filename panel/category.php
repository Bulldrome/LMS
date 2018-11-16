<?php
require_once 'header.php';
//SELECT ALL Cat
$sql = 'SELECT * FROM m_category WHERE status=1';
$res = mysql_query($sql);
$category = array();
while ($t = mysql_fetch_assoc($res)) {
    $category[] = $t;
}


if ($_GET) {
    if ($_GET['a'] == 'del') { //Delete Cat
        $sql = 'UPDATE m_category set status=0 WHERE id=' . $_GET['id'];
        mysql_query($sql);
        echo '<script>
            location.href = "category.php";
        </script>';
    }
}
?>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="category.php" class="tip-bottom">
                <i class="icon icon-info-sign"></i>
                List</a>
        </div>
        <h1>List.</h1>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row">
            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>List</h5>
                    </div>
                    <div class="widget-content ">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>编号</th>
                                            <th>模块名称</th>
                                            <th>描述</th>
                                            <th>封面</th>
                                            <th>创建时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (!empty($category)) {
                                            foreach ($category as $i => $u):
                                                ?>

                                                <tr>
                                                    <td><?= ($i + 1) ?></td>
                                                    <td><?= $u['title'] ?></td>
                                                    <td><?= mb_substr($u['description'],0,20,'gbk') ?></td>
                                                    <td>
                                                        <a href="<?= $u['thumb'] ?>" target="_blank">
                                                            <img src="<?= $u['thumb'] ?>" width="100" style="width: 150px;height: 55px;" height="75"/>
                                                        </a>
                                                    </td>
                                                    <td><?= date('Y-m-d H:i',$u['created'])?></td>
                                                    <td>
                                                        <a href="category.php?a=del&id=<?= $u['id'] ?>" ><i class="icon-remove"></i></a>
                                                    </td>

                                                </tr>


                                            <?php endforeach;
                                        }else{
                                        ?>
                                         <tr>
                                             <td colspan="5">Empty.</td>
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
            </div>
</div>
<?php
include('footer.php');
?><script>
    $(document).ready(function(){
        $("#Nav>li").removeClass("active");
        $("#Nav>li#Post").addClass("active");
        $("#Nav>li#Post>ul").slideDown();
    });
</script>
