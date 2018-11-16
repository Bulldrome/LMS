<?php
set_time_limit(0);
//phpinfo();
include('header3P.php');
$msg = '';
if ($_POST) { //AddCATE
    if (empty($_POST['title'])||empty($_POST['score'])) {
        $msg = 'All Field Are Required.';
    } else {

        $sql = 'INSERT INTO m_question(userid,courseid,question_name,score,question_category,question_type,created) 
VALUES("'.$_SESSION['userid'].'","'.$_POST['category'].'","'.str_replace('"','\'',$_POST['title']).'","'.$_POST['score'].'","'.$_POST['category'].'","'.$_POST['type'].'","'.time(). '")';
        //echo $sql;exit;
        mysql_query($sql);
        echo '<script>
                location.href = "question.php";
        </script>';
    }
}


$sql = 'SELECT * FROM m_type WHERE status=1';
$res = mysql_query($sql);
$type = array();
while ($t = mysql_fetch_assoc($res)) {
    $type[] = $t;
}

$sql = 'SELECT * FROM c_course WHERE status=1 AND teacher_id='.$_SESSION['userid'];
//echo $sql;
$res = mysql_query($sql);
$cate = array();
while ($t = mysql_fetch_assoc($res)) {
    $cate[] = $t;
}
//var_dump($cate);
?>
    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="question_add.php" class="tip-bottom">
                    <i class="icon icon-info-sign"></i>
                    Add</a>
            </div>
            <h1>Add question.</h1>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">
            <div class="row">
            <div class="span10">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Question add</h5>
                </div>
                <div class="widget-content ">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="control-group">
                            <label for="inputEmail" class="">Question name</label>
                            <textarea style="width: 100%" name="title" id="" required cols="30" rows="10"></textarea>

                        </div>
                        <div class="control-group">
                            <label for="inputEmail" class="">Score</label>
                            <input style="width: 70%"  type="text" name="score"/>
                        </div>
                        <div class="control-group">
                            <label for="inputEmail" class="">Course</label>
                            <select name="category" id="" required>

                                <?php
                                if (!empty($cate)) {
                                foreach ($cate as $i => $u):
                                ?>
                                    <option value="<?php echo $u['id']?>"><?php echo $u['course_name']?></option>
                                <?php endforeach;}?>
                            </select>
                        </div>

                        <div class="control-group">
                            <label for="inputEmail" class="">Question type</label>
                            <select name="type" id="" required>
                                <?php
                                if (!empty($type)) {
                                    foreach ($type as $i => $u):
                                        ?>
                                        <option value="<?php echo $u['id']?>"><?php echo $u['type_name']?></option>
                                    <?php endforeach;}?>
                            </select>
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

<script src="../js/kindeditor-4.1.10/kindeditor-min.js"></script>
<script>
    var editor;
    KindEditor.ready(function (K) {
        editor = K.create('textarea[name="title"]', {
            uploadJson: '../js/kindeditor-4.1.10/php/upload_json.php',
            fileManagerJson: '../js/kindeditor-4.1.10/php/file_manager_json.php',
            allowFileManager: true,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'image', 'link','fullscreen'],
            afterBlur: function () {
                this.sync();
            }
        });
    });

</script>
