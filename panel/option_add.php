<?php
include('header3P.php');
$msg = '';
if ($_POST) { //AddCATE
    if (empty($_POST['num'])) {
        $msg = 'All Field Are Required.';
    } else {
       // mysql_query($sql);
        echo '<script>
                location.href = "option_add2.php?id='.$_POST['qid'].'&num='.$_POST['num'].'";
        </script>';
    }
}
?>

    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="option_add.php" class="tip-bottom">
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
                    <form action="option_add.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="control-group">
                            <label for="inputEmail" class="">Option num</label>
                            <input value="4" type="number" min="1" max="10" name="num"/>
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