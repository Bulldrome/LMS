<?php
require_once 'header.php';
//SELECT ALL Cat
$sql = 'SELECT * FROM m_record WHERE status=1 AND user_id='.$_SESSION['userid'];
$res = mysql_query($sql);
$data = array();
while ($t = mysql_fetch_assoc($res)) {
    $sql = 'SELECT * FROM m_exam WHERE id='.$t['exam_id'];
    $exam = mysql_query($sql);
    $exam = mysql_fetch_assoc($exam);
    $t['exam'] = $exam;
    $data[] = $t;
}
?>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="log.php" class="tip-bottom">
                <i class="icon icon-info-sign"></i>
                Data</a>
        </div>
        <h1>Data.</h1>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row">
            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Data</h5>
                    </div>
                    <div class="widget-content ">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Exam</th>
                                            <th>Description</th>
                                            <th>Score</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (!empty($data)) {
                                            foreach ($data as $i => $u):
                                                ?>

                                                <tr>
                                                    <td><?= ($i + 1) ?></td>
                                                    <td><?= $u['exam']['title'] ?></td>
                                                    <td><?= mb_substr($u['exam']['description'],0,20,'gbk') ?></td>
                                                    <td><?php echo $u['score'];?></td>
                                                    <td><?= date('Y-m-d H:i',$u['created'])?></td>


                                                    <td>
                                                        <a href="view_result.php?id=<?php echo $u['exam']['id']; ?>">
                                                            VIEW
                                                        </a>
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
        $("#Nav>li#StartExam").addClass("active");
        $("#Nav>li#StartExam>ul").slideDown();
    });
</script>
