<?php
include('header3P.php');
$msg = '';
if ($_POST) { //AddCATE
    if (empty($_POST['answer'])) {
        $msg = 'All Field Are Required.';
    } else {

        $sql = 'INSERT INTO m_answer(qid,answer,created) VALUES("'.$_POST['qid'].'","'.$_POST['answer'].'",'.time().')';
        mysql_query($sql);
        $sql = 'UPDATE m_question SET step=3 WHERE id='.$_POST['qid'];
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
                <a href="option_add.php" class="tip-bottom">
                    <i class="icon icon-info-sign"></i>
                    添加答案</a>
            </div>
            <h1>添加答案.</h1>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">
            <div class="row">
            <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>添加答案</h5>
                </div>
                <div class="widget-content ">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="control-group">
                            <label for="inputEmail" class="">答案</label>
                            <textarea class="form-actions" name="answer" id="" cols="60" rows="10" style="width: 80%"></textarea>
                            <input type="hidden" name="qid" value="<?php echo $_GET['id'];?>"/>
                        </div>

                        <div class="control-group">
                            <div class="checkbox">
                                <label style="color: #c00">
                                    <?= $msg ?>
                                </label>
                            </div>
                        </div>
                        <div class="control-group">

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">提交</button>
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