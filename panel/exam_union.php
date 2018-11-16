<?php
require_once 'header.php';
$qid = $_GET['id'];
//SELECT ALL Cat
$sql = 'SELECT * FROM m_question WHERE status=1 AND question_type=1 AND step=3';
$res = mysql_query($sql);
$data = array();
while ($t = mysql_fetch_assoc($res)) {
    $data[] = $t;
}


$sql = 'SELECT * FROM m_question WHERE status=1 AND question_type=2  AND step=3';
$res = mysql_query($sql);
$data2 = array();
while ($t = mysql_fetch_assoc($res)) {
    $data2[] = $t;
}

$sql = 'SELECT * FROM m_question WHERE status=1 AND question_type=3 AND step=3';
$res = mysql_query($sql);
$data3 = array();
while ($t = mysql_fetch_assoc($res)) {
    $data3[] = $t;
}


if($_POST)
{
    $questions = $_POST['question'];
   // var_dump($questions);
    if(count($questions)<1)
    {
        echo '<script>';
        echo 'alert("Select Question");';
        echo '</script>';
        exit;
    }else{
        foreach($questions as $q)
        {
            $sql = 'INSERT INTO m_examunion(question_id,exam_id,created) VALUES ("'.$q.'","'.$_POST['qid'].'",'.time().')';
            mysql_query($sql);
        }

        $sql = 'UPDATE m_exam SET step=2 WHERE id='.$_POST['qid'];
        mysql_query($sql);
        echo '<script>';
        echo 'alert("Operate Success.");';
        echo 'window.location.href="exam.php";';
        echo '</script>';
        exit;
    }
}

?>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="javascript:;" class="tip-bottom">
                <i class="icon icon-info-sign"></i>
                Add</a>
        </div>
        <h1>Add.</h1>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <form action="" method="post">
            <input type="hidden" name="hxdfsf" value="1"/>
            <input type="hidden" name="qid" value="<?php echo $qid;?>"/>
        <div class="row">
            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Single/Multi Question/Blank</h5>
                    </div>
                    <div class="widget-content " style="overflow: hidden">
                        <div class="span6">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="checkAll"/>
                                            </th>
                                            <th>Question</th>
                                            <th>Score</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (!empty($data)) {
                                            foreach ($data as $i => $u):
                                                ?>

                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="question[]" value="<?php echo $u['id'];?>"/>
                                                    </td>
                                                    <td><?= substr(strip_tags($u['question_name']),0,105) ?></td>
                                                    <td><?= $u['score'] ?></td>

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
                        <div class="span6">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        <input  type="checkbox" id="checkAll"/>
                                    </th>
                                    <th>Question</th>
                                    <th>Score</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!empty($data2)) {
                                    foreach ($data2 as $i => $u):
                                        ?>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="question[]" value="<?php echo $u['id'];?>"/>
                                            </td>
                                            <td><?= substr(strip_tags($u['question_name']),0,105) ?></td>
                                            <td><?= $u['score'] ?></td>

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
                        <div class="span6">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="checkAll"/>
                                    </th>
                                    <th>Question</th>
                                    <th>Score</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!empty($data3)) {
                                    foreach ($data3 as $i => $u):
                                        ?>

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="question[]" value="<?php echo $u['id'];?>"/>
                                            </td>
                                            <td><?= substr(strip_tags($u['question_name']),0,105) ?></td>
                                            <td><?= $u['score'] ?></td>

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

<div class="span11">
    <button class="btn btn-success">Submit</button>
</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</form>
</div>
<?php
include('footer.php');
?><script>
    $(document).ready(function(){
        $("#Nav>li").removeClass("active");
        $("#Nav>li#Exam").addClass("active");
        $("#Nav>li#Exam>ul").slideDown();
    });
</script>
