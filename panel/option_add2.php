<?php
include('header3P.php');
$msg = '';
$num = $_GET['num'];
$qid = $_GET['id'];

$sql = 'SELECT * FROM m_question WHERE id='.$qid;
$ques = mysql_query($sql);
$ques = mysql_fetch_assoc($ques);


$opt_arr = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q');
if ($_POST) { //AddCATE
    if (empty($_POST['num'])) {
        $msg = 'All Field Are Required..';
    } else {
        $que_id = $_POST['qid'];
        $ans_num = $_POST['num'];
        $sql = 'SELECT * FROM m_question WHERE id='.$que_id;
        $ques = mysql_query($sql);
        $ques = mysql_fetch_assoc($ques);

        for($i=0;$i<$ans_num;$i++)
        {
            $input_val = $_POST['option'.$i];
            $option_tag = $opt_arr[$i];
            $is_answer = 0;
            if($ques['question_type']==1)
            {
                $ianswer = $_POST['answer'];
                if($ianswer==$i)
                {
                    $is_answer = 1;
                }
            }
            if($ques['question_type']==2)
            {
                $ianswer = $_POST['answer'];
                foreach($ianswer as $an)
                {
                    if($an==$i)
                    {
                        $is_answer = 1;
                    }
                }
            }
            $sql = 'INSERT INTO m_option(created,question_id,option_name,option_tag,is_answer) VALUES('.time().',"'.$que_id.'","'.$input_val.'","'.$option_tag.'","'.$is_answer.'")';
            mysql_query($sql);
        }
//var_dump($_POST);
   //     exit;

        $sql = 'UPDATE m_question SET step=3 WHERE id='.$que_id;
        mysql_query($sql);
        echo '<script>';
        echo 'alert("Add Success.");';
        echo 'window.location.href="question.php";';
        echo '</script>';
        exit;
    }
}
?>

    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="#" class="tip-bottom">
                    <i class="icon icon-info-sign"></i>
                    Add option</a>
            </div>
            <h1>Add option.</h1>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">
            <div class="row">
            <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Add option</h5>
                </div>
                <div class="widget-content ">
                    <form action="option_add2.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    <input type="hidden" name="qid" value="<?php echo $qid;?>"/>
                        <input type="hidden" name="num" value="<?php echo $num;?>"/>

                        <?php
                            for($i=0;$i<$num;$i++)
                            {

                            ?>
                                <div class="control-group">
                                    <?php
                                    if($ques['question_type']==1)
                                    {
                                    ?>
                                    <input type="radio" name="answer" value="<?php echo $i;?>"/> Is answer?
                                    <?php }?>
                                    <?php
                                    if($ques['question_type']==2)
                                    {
                                        ?>
                                        <input checked type="checkbox" name="answer[]" value="<?php echo $i;?>"/> Is answer?
                                    <?php }?>
                                    <label for="inputEmail" class=""><?php echo $opt_arr[$i];?></label>
                                    <input style="width: 85%" type="text" name="option<?php echo $i;?>"/>
                                </div>
                            <?php
                            }
                        ?>

                        <div class="control-group">
                            <div class="checkbox">
                                <label style="color: #c00">
                                    <?= $msg ?>
                                </label>
                            </div>
                        </div>
                        <div class="control-group">

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
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
<script>
    $(document).ready(function(){
        $("#Nav>li").removeClass("active");
        $("#Nav>li#Ecog").addClass("active");
        $("#Nav>li#Ecog>ul").slideDown();
    });
</script>