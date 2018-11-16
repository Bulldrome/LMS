<?php
require_once 'header.php';

$sql = 'SELECT * FROM m_config WHERE id=1';
$res = mysql_query($sql);
$config = mysql_fetch_assoc($res);

$sql = 'SELECT * FROM m_record WHERE user_id='.$_SESSION['userid'].' AND status=1 AND exam_id='.$config['current_exam'];
$exist = mysql_query($sql);
$exist = mysql_fetch_assoc($exist);
if($exist)
{
    echo '<script>';
    echo 'alert("You Have Been Submited.");';
    echo 'window.location.href="index.php";';
    echo '</script>';
    exit;
}


$sql = 'INSERT INTO m_record(user_id,exam_id,created) VALUES("'.$_SESSION['userid'].'","'.$config['current_exam'].'",'.time().')';
mysql_query($sql);

$exam = 'SELECT * FROM m_exam WHERE id='.$config['current_exam'];
$exam = mysql_query($exam);
$exam = mysql_fetch_assoc($exam);

//SELECT ALL Cat
$sql = 'SELECT * FROM m_examunion WHERE status=1 AND exam_id='.$config['current_exam'];
$res = mysql_query($sql);
$data = array();
while ($t = mysql_fetch_assoc($res)) {
    $sql = 'SELECT * FROM m_question WHERE id='.$t['question_id'];
    $qres = mysql_query($sql);
    $ques = mysql_fetch_assoc($qres);


    $sql = 'SELECT * FROM m_option WHERE question_id='.$ques['id'];
    $ores = mysql_query($sql);
    $opts = array();
    while($m=mysql_fetch_assoc($ores))
    {
        $opts[] = $m;
    }


    if($ques['question_type']==3)
    {
        $sql = 'SELECT * FROM m_answer WHERE qid='.$ques['id'];
        $ques1 = mysql_query($sql);
        $ques1 = mysql_fetch_assoc($ques1);
        $t['answer'] = $ques1['answer'];
    }
    $t['option'] = $opts;
    $t['question'] = $ques;
    $data[] = $t;
}
?>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="javascript:;" class="tip-bottom">
                <i class="icon icon-info-sign"></i>
                Exam</a>
        </div>
        <h1>Exam.</h1>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row">
            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Exam</h5>
                    </div>
                    <style>
                        .table tr td,.table tr th{text-align: left;}
                    </style>
                    <div class="widget-content ">
                        <form action="submit.php" method="post">
                            <input type="hidden" name="current_exam" value="<?php echo $config['current_exam'];?>"/>

                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><?php echo $exam['title'];?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (!empty($data)) {
                                            foreach ($data as $i => $u):
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $i+1;?>、
                                                        <?php
                                                        echo $u['question']['question_name'];
                                                        ?>
                                                        （<?php
                                                        echo $u['question']['score'];
                                                        ?>）
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                <?php
                                                if($u['question']['question_type']==3)
                                                {
                                                    ?>

                                                    <textarea name="answer<?php echo $u['id'];?>" style="width: 80%" id="" cols="30" rows="5"></textarea>
                                                    <br/> <br/>



                                                <?php }else{?>
<?php
if(!empty($u['option']))
{
        //var_dump($u['option']);
    $right = array();
    foreach($u['option'] as $j=>$op)
    {
        if($op['is_answer']==1){ $right[] = $j;}
        ?>


        <?php
        if($u['question']['question_type']==1)
        {
        ?>
            <input type="radio" value="<?php echo $op['id'];?>" name="answer<?php echo $u['id'];?>"/>
            <?php echo $op['option_tag'];?>、
            <?php echo $op['option_name'];?>
            <br/><br/>

            <?php }?>



        <?php
        if($u['question']['question_type']==2)
        {
            ?>
            <input type="checkbox" value="<?php echo $op['id'];?>" name="answer<?php echo $u['id'];?>[]"/>
            <?php echo $op['option_tag'];?>、
            <?php echo $op['option_name'];?>
            <br/><br/>
        <?php }?>




    <?php }
    ?>



<?php
}
?>

                                                <?php
                                                }
                                                ?>
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
                                        <tr>
                                            <td>
                                                <button class="btn btn-success">Submit</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                        </form>
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
