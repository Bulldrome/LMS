<?php
include('header.php');
$msg = '';
if ($_POST) { //AddCATE
    if (empty($_POST['name'])) {
        $msg = 'All Field Are Required.';
    } else {

        $thumb = '/uploads/photo/' . time() . '.png';
        move_uploaded_file($_FILES['thumb']['tmp_name'], '..' . $thumb);


        $sql = 'INSERT INTO m_category(thumb,created,title,description) VALUES("'.$thumb.'",'.time().',"' . $_POST['name'] . '","' . $_POST['desc'] . '")';
        mysql_query($sql);
        echo '<script>
                location.href = "category.php";
            </script>';
    }
}




?>

    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="category_add.php" class="tip-bottom">
                    <i class="icon icon-info-sign"></i>
                    Add</a>
            </div>
            <h1>Add.</h1>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">
            <div class="row">
            <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Add</h5>
                </div>
                <div class="widget-content ">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="control-group">
                            <label for="inputEmail" class="">模块名称</label>
                            <input type="text" name="name" id="inputEmail" class="form-control" placeholder="Category Name" required autofocus>
                        </div>
                        <div class="control-group">
                            <label for="inputPassword" class="">封面</label>
                            <input type="file" name="thumb" required/>
                        </div>
                        <div class="control-group">
                            <label for="inputPassword" class="">描述</label>
                            <textarea style="width: 100%" name="desc" id="" required cols="30" rows="10"></textarea>
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
        $("#Nav>li#Post").addClass("active");
        $("#Nav>li#Post>ul").slideDown();
    });
</script>