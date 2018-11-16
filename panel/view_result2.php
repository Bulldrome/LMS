<?php
require_once 'header.php';
$config['current_exam']= $_GET['id'];
$exam = 'SELECT * FROM m_exam WHERE id='.$config['current_exam'];
$exam = mysql_query($exam);
$exam = mysql_fetch_assoc($exam);


$total = 0;

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

    $t['option'] = $opts;
    $t['question'] = $ques;




    $sql = 'SELECT * FROM m_log WHERE user_id='.$_GET['uid'].' AND exam_id='.$config['current_exam'].' AND status=1 AND question_id='.$ques['id'];
    $log = mysql_query($sql);
    $log = mysql_fetch_assoc($log);


    if($ques['question_type']!=3)
    {
        $my_answer = $log['my_answer'];
        $m_ans = explode(',',$my_answer);

        $my_answer = '';
        foreach($m_ans as $s)
        {
            $sql = 'SELECT * FROM m_option WHERE id='.$s;
            $option_m = mysql_query($sql);
            $option_m = mysql_fetch_assoc($option_m);
            $my_answer .=$option_m['option_tag'];
        }
        $t['my_answer'] = $my_answer;
    }else{
        $my_answer = $log['my_answer'];
        $t['my_answer'] = $my_answer;
    }

    if($log['result']==1)
    {
        $total +=$ques['score'];
        $t['is_pass'] = 1;
        $t['score'] = $ques['score'];
    }else{
        $t['is_pass'] =0;
        $t['score'] = 0;
    }


    if($ques['question_type']==3)
    {
        $sql = 'SELECT * FROM m_answer WHERE qid='.$ques['id'];
        $ques1 = mysql_query($sql);
        $ques1 = mysql_fetch_assoc($ques1);
        $t['answer'] = $ques1['answer'];
    }


    $data[] = $t;
}


?>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="javascript:;" class="tip-bottom">
                <i class="icon icon-info-sign"></i>
                Score</a>
        </div>
        <h1>Score.</h1>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row">
            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Score</h5>
                    </div>
                    <style>
                        .table tr td,.table tr th{text-align: left;}
                    </style>
                    <div class="widget-content ">

                        <div class="alert alert-success alert-block">
                            <h4 class="alert-heading">Score:</h4> <br/>
                            <span style="color: #c00;font-size: 25px;font-weight:bold"><?php echo $total;?></span>
                             </div>

                        <form action="" method="post">
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
                                                    <td>  <?php
                                                if($u['question']['question_type']==3)
                                                {
                                                    ?>


                                                    <span style="display: inline-block;color: #000088">Correct Answer </span>:<?php echo $u['answer'];?>

                                                    <?php
                                                    if($u['is_pass']==1)
                                                    {
                                                        ?>
                                                        <span style="color: #000088;font-weight: bold;">
        Y
    </span>
                                                    <?php }?>

                                                    <?php
                                                    if($u['is_pass']==0)
                                                    {
                                                        ?>
                                                        <span style="color: #c00;font-weight: bold;">
        N
    </span>
                                                    <?php }?>



                                                    Your Answer:<span><?php echo $u['my_answer'];?></span>


                                                    <span style="color: #000080">Score</span>
                                                    <span><?php echo $u['score'];?></span>


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
    <span style="display: inline-block;color: #000088">Answer <em>
            <?php
            foreach($right as $ms)
            {
                echo $u['option'][$ms]['option_tag'];
            }
            ?>
        </em>
    </span>
        <?php
        if($u['is_pass']==1)
        {
        ?>
    <span style="color: #000088;font-weight: bold;">
        Y
    </span>
            <?php }?>

    <?php
    if($u['is_pass']==0)
    {
        ?>
        <span style="color: #c00;font-weight: bold;">
        N
    </span>
    <?php }?>

    <span>Choose <?php echo $u['my_answer'];?></span>
    <span style="color: #000080">Score</span>
    <span><?php echo $u['score'];?></span>


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
