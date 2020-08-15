<?php
function dump(){
    foreach(func_get_args() as $arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
}
function dd(){
    dump(...func_get_args());
    exit;
}

function user(){
    return isset($_SESSION['user']);
}

function go($url, $message = null){
    echo "<script>";
    if($message) echo "alert('$message');";
    echo "location.href='$url';";
    echo "</script>";
    exit;
}

function back($message = null){
    echo "<script>";
    if($message) echo "alert('$message');";
    echo "history.back();";
    echo "</script>";
    exit;
}

function json_response($data = []){
    if(!is_array($data)) $data = ['message' => $data];
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function view($viewName, $data = []){
    $viewFile = VIEW."/$viewName.php";
    extract($data);
    if(is_file($viewFile)){
        require VIEW."/header.php";
        require $viewFile;
        require VIEW."/footer.php";
        exit;
    }
}

function checkEmpty(){
    foreach($_POST as $input){
        if(!is_array($input) && trim($input) === "") back("모든 정보를 입력해 주세요.");
    }
}

function pager($data){
    $PAGE__LIST = 8;
    $PAGE__BLOCK = 5;

    $page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] >= 1 ? $_GET['page'] : 1;
    
    $total_page = ceil(count($data) / $PAGE__LIST);
    $current_block = ceil($page / $PAGE__BLOCK);
    $start = $current_block & $PAGE__BLOCK - $PAGE__BLOCK + 1;
    $end = $start + $PAGE__BLOCK - 1;
    
    $prev_page = $start - 1;
    $next_page = $end + 1;
    $prev = $prev_page >= 1;
    $next = $next_page <= $total_page;

    $data = array_slice($data, ($page - 1) * $PAGE__LIST, $PAGE__LIST);
    
    return (object)compact("data", "page", "start", "end", "prev", "next", "prev_page", "next_page");
}

function ext_name($filename){
    return substr($filename, strrpos($filename, "."));
}
