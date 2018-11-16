<?php
require_once 'header3P.php';
//SELECT ALL Cat
$sql = 'SELECT * FROM m_exam WHERE status=1';
$res = mysql_query($sql);
$data = array();
while ($t = mysql_fetch_assoc($res)) {
    $data[] = $t;
}


if ($_GET) {
    if ($_GET['a'] == 'del') { //Delete Cat
        $sql = 'UPDATE m_exam set status=0 WHERE id=' . $_GET['id'];
        mysql_query($sql);
        echo '<script>
            location.href = "exam.php";
        </script>';
    }
}
?>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="exam.php" class="tip-bottom">
                <i class="icon icon-info-sign"></i>
                List</a>
        </div>
        <h1>Examination paper.</h1>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row">
            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Examination paper</h5>
                    </div>
                    <div class="widget-content ">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Examination paper</th>
                                            <th>Testing time</th>
                                            <th>--</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (!empty($data)) {
                                            foreach ($data as $i => $u):
                                                ?>

                                                <tr>
                                                    <td><?= ($i + 1) ?></td>
                                                    <td><?= $u['title'] ?></td>                                                   
                                                    <td><?= date('Y-m-d H:i',$u['created'])?></td>                                                    
                                                    <td>
													<a href="view_result.php?id=<?php echo $u['id'];?>">[Result detail]</a>
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
        $("#Nav>li#Exam").addClass("active");
        $("#Nav>li#Exam>ul").slideDown();
    });
</script>
