<?php
header('content-type:text/html;charset=utf8');
require_once '../include/config.inc.php';

if($_POST)
{

    $exam_id = $_POST['current_exam'];
    $exam = 'SELECT * FROM m_exam WHERE id='.$exam_id;
    $exam = mysql_query($exam);
    $exam = mysql_fetch_assoc($exam);

//SELECT ALL Cat
    $sql = 'SELECT * FROM m_examunion WHERE status=1 AND exam_id='.$exam_id;
    $res = mysql_query($sql);
    $data_exam = array();
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
        $data_exam[] = $t;
    }



    foreach($data_exam as $i=>$e)
    {
        if($e['question']['question_type']==3)
        {
            $user_answer = $_POST['answer'.$e['id']];
            $tsql = 'SELECT * FROM m_answer WHERE qid='.$e['question']['id'];
            $tqes = mysql_query($tsql);
            $tqes = mysql_fetch_assoc($tqes);
            if($user_answer==$tqes['answer'])
            {
                $sql = 'INSERT INTO m_log(user_id,exam_id,question_id,my_answer,true_answer,score,result,created)
        VALUES("'.$_SESSION['userid'].'","'.$exam_id.'","'.$e['question']['id'].'",
        "'.$user_answer.'","'.$tqes['answer'].'","'.$e['question']['score'].'",1,'.time().')';
            }else{
                $sql = 'INSERT INTO m_log(user_id,exam_id,question_id,my_answer,true_answer,score,result,created)
        VALUES("'.$_SESSION['userid'].'","'.$exam_id.'","'.$e['question']['id'].'",
        "'.$user_answer.'","'.$tqes['answer'].'","0",0,'.time().')';
            }
        }else{
        $true_user_answer = '';
        $true_user_answer2 = '';
        $user_answer = $_POST['answer'.$e['id']];

        if($e['question']['question_type']==2)
        {
            if(!empty($user_answer))
            {
                foreach($user_answer as $l=>$u)
                {
                    $true_user_answer .= $u;
                    if($l!=(count($user_answer)-1))
                    {
                        $true_user_answer2 .=$u.',';
                    }else{
                        $true_user_answer2 .=$u;
                    }
                }
            }
        }else{
            $true_user_answer = $user_answer;
            $true_user_answer2 = $user_answer;
        }


        $sys_true_answer = '';
        $sys_true_answer2 = '';

        foreach($e['option'] as $m=>$op)
        {
            if($op['is_answer']==1)
            {
                if($e['question']['question_type']==2)
                {
                    if($l!=(count($e['option'])-1))
                    {
                        $sys_true_answer2 .=$op['id'].',';
                    }else{
                        $sys_true_answer2 .=$op['id'];
                    }
                    $sys_true_answer .=$op['id'];
                }else{
                    $sys_true_answer =$op['id'];
                    $sys_true_answer2 = $sys_true_answer;
                }
            }
        }


        //
        if($true_user_answer==$sys_true_answer)
        {
            $sql = 'INSERT INTO m_log(user_id,exam_id,question_id,my_answer,true_answer,score,result,created)
        VALUES("'.$_SESSION['userid'].'","'.$exam_id.'","'.$e['question']['id'].'",
        "'.$true_user_answer2.'","'.$sys_true_answer2.'","'.$e['question']['score'].'",1,'.time().')';
        }else{
            $sql = 'INSERT INTO m_log(user_id,exam_id,question_id,my_answer,true_answer,score,result,created)
        VALUES("'.$_SESSION['userid'].'","'.$exam_id.'","'.$e['question']['id'].'",
        "'.$true_user_answer2.'","'.$sys_true_answer2.'","0",0,'.time().')';
        }
    }
        mysql_query($sql);
    }

    echo '<script>';
    echo 'alert("Submit success.");';
    echo 'window.location.href="result.php?eId='.$_POST['current_exam'].'";';
    echo '</script>';
    exit;

}