<?php
require_once 'header3P.php';
//SELECT ALL Cat
$sql = 'SELECT * FROM m_question WHERE status=1 AND userid='.$_SESSION['userid'];
$res = mysql_query($sql);
$data = array();
while ($item = mysql_fetch_assoc($res)) {
    $sql = 'SELECT * FROM c_course WHERE id='.$item['courseid'];
    $cres = mysql_query($sql);
    $item['category'] = mysql_fetch_assoc($cres);


    $sql = 'SELECT * FROM m_type WHERE id='.$item['question_type'];
    $cres = mysql_query($sql);
    $item['type'] = mysql_fetch_assoc($cres);

    $data[] = $item;
}


if ($_GET) {
    if ($_GET['a'] == 'del') { //Delete Cat
        $sql = 'UPDATE m_question set status=0 WHERE id=' . $_GET['id'];
        mysql_query($sql);
        echo '<script>
            location.href = "question.php";
        </script>';
    }
}
?>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="category.php" class="tip-bottom">
                <i class="icon icon-info-sign"></i>
                Question list</a>
        </div>
        <h1>Question list.</h1>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row">
            <div class="span11">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Question list.</h5>
                    </div>
                    <div class="widget-content ">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Question </th>
                                            <th>Course</th>
                                            <th>Type</th>
                                            <th>Score</th>
                                            <th>State</th>
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
                                                    <td><?= substr(strip_tags($u['question_name']),0,105) ?></td>
                                                    <td><?= $u['category']['course_name'] ?></td>
                                                    <td><?= $u['type']['type_name'] ?></td>
                                                    <td><?= $u['score'] ?></td>
                                                    <td>
                                                        <?php
                                                        if($u['step']==1||$u['step']==2)
                                                        {?>
                                                         <span style="color: #c00">N</span>
                                                        <?php }else{?>
                                                            <span style="color: #000088">Y</span>
                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                <?php
                                                if($u['step']==1&$u['question_type']!=3)
                                                {?>
[<a href="option_add.php?id=<?php echo $u['id'];?>">Add option</a>
                                                    ]
                                                    <?php
                                                }
                                                    ?>

                                                        <?php
                                                        if($u['step']==1&$u['question_type']==3)
                                                        {?>
                                                            [<a href="answer_add.php?id=<?php echo $u['id'];?>">Add answer</a>
                                                            ]
                                                        <?php
                                                        }
                                                        ?>

                                                        <?php
                                                        if($u['step']==3&$u['question_type']!=3)
                                                        {?>
                                                            [<a href="option_view.php?id=<?php echo $u['id'];?>">View</a>
                                                            ]
                                                        <?php
                                                        }
                                                        ?>
                                                        <a href="question.php?a=del&id=<?= $u['id'] ?>" ><i class="icon-remove"></i></a>
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
        $("#Nav>li#Ecog").addClass("active");
        $("#Nav>li#Ecog>ul").slideDown();
    });
</script>
