<?php
require_once 'header.php';
$sql = 'SELECT * FROM m_config WHERE id=1';
$res = mysql_query($sql);
$config = mysql_fetch_assoc($res);

$exam = 'SELECT * FROM m_exam WHERE id='.$config['current_exam'];
$exam = mysql_query($exam);
$exam = mysql_fetch_assoc($exam);


$sql = 'SELECT COUNT(*) FROM m_record WHERE exam_id='.$exam['id'];
$cres = mysql_query($sql);
$count = mysql_fetch_assoc($cres);
$count = $count['COUNT(*)'];

//echo '==='.$count;
$limit = intval(ceil($count/4));

$sql = 'SELECT * FROM m_record WHERE exam_id='.$exam['id'].' AND score>60 ORDER BY score DESC';
$sc_res = mysql_query($sql);

$data1 = array();
while($row=mysql_fetch_assoc($sc_res))
{
    $sql = 'SELECT * FROM m_user WHERE id='.$row['user_id'];
    $u = mysql_query($sql);
    $row['user'] = mysql_fetch_assoc($u);

    $data1[] = $row;
}


$sql = 'SELECT * FROM m_record WHERE exam_id='.$exam['id'].' AND (score<61 AND score>39) ORDER BY score DESC';
//echo $sql;
$sc_res = mysql_query($sql);
$data2 = array();
while($row=mysql_fetch_assoc($sc_res))
{
    $sql = 'SELECT * FROM m_user WHERE id='.$row['user_id'];
    $u = mysql_query($sql);
    $row['user'] = mysql_fetch_assoc($u);

    $data2[] = $row;
}

$sql = 'SELECT * FROM m_record WHERE exam_id='.$exam['id'].' (score<40 AND score>25) ORDER BY score DESC';
$sc_res = mysql_query($sql);
$data3 = array();
while($row=mysql_fetch_assoc($sc_res))
{
    $sql = 'SELECT * FROM m_user WHERE id='.$row['user_id'];
    $u = mysql_query($sql);
    $row['user'] = mysql_fetch_assoc($u);

    $data3[] = $row;
}


$sql = 'SELECT * FROM m_record WHERE exam_id='.$exam['id'].' AND score<26 ORDER BY score DESC';
$sc_res = mysql_query($sql);
$data4 = array();
while($row=mysql_fetch_assoc($sc_res))
{
    $sql = 'SELECT * FROM m_user WHERE id='.$row['user_id'];
    $u = mysql_query($sql);
    $row['user'] = mysql_fetch_assoc($u);

    $data4[] = $row;
}




?>

<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="report.php" class="tip-bottom">
                <i class="icon icon-info-sign"></i>
                Report</a>
        </div>
        <h1>Report.</h1>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row">
            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Network Team Report</h5>
                    </div>
                    <div class="widget-content ">
                        <div class="alert alert-success alert-block">
                            <h4 class="alert-heading">Suggestion:</h4> <br/>
                            <div>Good Score.</div>
                        </div>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>UserName</th>
                                            <th>Exam</th>
                                            <th>Score</th>
                                            <th>Suggestion</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (!empty($data1)) {
                                            foreach ($data1 as $i => $u):
                                                ?>

                                                <tr>
                                                    <td><?= ($i + 1) ?></td>
                                                    <td><?= $u['user']['username'] ?></td>
                                                    <td><?php echo $exam['title'];?></td>
                                                    <td><?php echo $u['score'];?>
                                                        [<a href="view_result2.php?uid=<?= $u['user']['id'] ?>&id=<?php echo $exam['id']; ?>">
                                                            VIEW
                                                        </a>]</td>
                                                    <td>
                                                        Network Team
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
            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Network Security Team</h5>
                    </div>
                    <div class="widget-content ">
                        <div class="alert alert-success alert-block">
                            <h4 class="alert-heading">Suggestion:</h4> <br/>
                            <div>Operation of IP Data Network is not quite good.</div>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>UserName</th>
                                <th>Exam</th>
                                <th>Score</th>
                                <th>Suggestion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($data2)) {
                                foreach ($data2 as $i => $u):
                                    ?>

                                    <tr>
                                        <td><?= ($i + 1) ?></td>
                                        <td><?= $u['user']['username'] ?></td>
                                        <td><?php echo $exam['title'];?></td>
                                        <td><?php echo $u['score'];?>
                                            [<a href="view_result2.php?uid=<?= $u['user']['id'] ?>&id=<?php echo $exam['id']; ?>">
                                                VIEW
                                            </a>]</td>
                                        <td>
                                            Network Security Team
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

            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Network Infrastructure Team</h5>
                    </div>
                    <div class="widget-content ">
                        <div class="alert alert-success alert-block">
                            <h4 class="alert-heading">Suggestion:</h4> <br/>
                            <div>Spanning tree, Access-List is not so familiar.</div>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>UserName</th>
                                <th>Exam</th>
                                <th>Score</th>
                                <th>Suggestion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($data3)) {
                                foreach ($data3 as $i => $u):
                                    ?>

                                    <tr>
                                        <td><?= ($i + 1) ?></td>
                                        <td><?= $u['user']['username'] ?></td>
                                        <td><?php echo $exam['title'];?></td>
                                        <td><?php echo $u['score'];?>
                                            [<a href="view_result2.php?uid=<?= $u['user']['id'] ?>&id=<?php echo $exam['id']; ?>">
                                                VIEW
                                            </a>]</td>
                                        <td>
                                            Network Infrastructure Team
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
            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Training</h5>
                    </div>
                    <div class="widget-content ">
                        <div class="alert alert-success alert-block">
                            <h4 class="alert-heading">Suggestion:</h4> <br/>
                            <div>Recommend to training. Please take the CCNA lesson.</div>
                        </div>
                        <table class="table table-bordered table-striped">

                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>UserName</th>
                                <th>Exam</th>
                                <th>Score</th>
                                <th>Suggestion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($data4)) {
                                foreach ($data4 as $i => $u):
                                    ?>

                                    <tr>
                                        <td><?= ($i + 1) ?></td>
                                        <td><?= $u['user']['username'] ?></td>
                                        <td><?php echo $exam['title'];?></td>
                                        <td><?php echo $u['score'];?>
                                            [<a href="view_result2.php?uid=<?= $u['user']['id'] ?>&id=<?php echo $exam['id']; ?>">
                                                VIEW
                                            </a>]
                                        </td>
                                        <td>
                                            Training
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
