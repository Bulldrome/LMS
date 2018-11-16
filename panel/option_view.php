<?php
require_once 'header3P.php';
//SELECT ALL Cat
$sql = 'SELECT * FROM m_option WHERE question_id='.$_GET['id'];
$res = mysql_query($sql);
$data = array();
while ($item = mysql_fetch_assoc($res)) {
    $data[] = $item;
}


if ($_GET) {
    if ($_GET['a'] == 'del') { //Delete Cat
        $sql = 'DELETE FROM m_option WHERE id=' . $_GET['oid'];
        mysql_query($sql);
        echo '<script>
            location.href = "option_view.php?id='.$_GET['id'].'";
        </script>';
    }
}
?>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="javascript:;" class="tip-bottom">
                <i class="icon icon-info-sign"></i>
                Question detail</a>
        </div>
        <h1>Question detail.</h1>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row">
            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Question detail</h5>
                    </div>
                    <div class="widget-content ">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Is answer</th>
                                            <th>--</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (!empty($data)) {
                                            foreach ($data as $i => $u):
                                                ?>

                                                <tr>
                                                    <td><?= $u['option_tag'] ?></td>
                                                    <td><?= $u['option_name'] ?></td>
                                                    <td>
                                                        <?php
                                                        if($u['is_answer'])
                                                        {?>
                                                            <span style="color: #000088">Y</span>
                                                        <?php }else{
                                                        ?>
                                                           <span style="color: #c00">N</span>
                                                            <?php }?>
                                                    </td>
                                                  <td>
                                                        <a href="option_view.php?a=del&oid=<?= $u['id']?>&id=<?= $u['question_id'] ?>" ><i class="icon-remove"></i></a>
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
        $("#Nav>li#Ecog").addClass("active");
        $("#Nav>li#Ecog>ul").slideDown();
    });
</script>
