<?php
/*
*公共函数库
**/

if (!function_exists('post')) {
    //接收POST表单值
    function post($key)
    {
        return $_POST[$key] ? $_POST[$key] : null;
    }
}

function generate_pwd()
{
    $arr = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
    $pwd = '';
    for($i=0;$i<6;$i++)
    {
        $pwd.=$arr[rand(0,count($arr))];
    }
    return strlen($pwd)>5?$pwd:generate_pwd();
}

//获取IP地址
function get_ip()
{
    global $_SERVER;
    if ($_SERVER) {
        if ($_SERVER[HTTP_X_FORWARDED_FOR])
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        else if ($_SERVER["HTTP_CLIENT_ip"])
            $realip = $_SERVER["HTTP_CLIENT_ip"];
        else
            $realip = $_SERVER["REMOTE_ADDR"];
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR'))
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_CLIENT_ip'))
            $realip = getenv('HTTP_CLIENT_ip');
        else
            $realip = getenv('REMOTE_ADDR');
    }
    return $realip;
}


function writeover($filename, $data, $method = "rb+")
{
    @touch($filename);
    if ($handle = @fopen($filename, $method)) {
        flock($handle, LOCK_EX);
        fputs($handle, $data);
        if ($method == "rb+") ftruncate($handle, strlen($data));
        fclose($handle);
    }
}

function redirect($url)
{
    echo '<script>
    location.href = "'.$url.'";
    </script>';
}

?>