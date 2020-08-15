<?php
namespace Controller;

use App\DB;
use PharData;
use ZipArchive;

class MainController {
    /**
     * PAGES
     */
    function homePage(){
        view("home");
    }

    function noticePage(){
        view("notice");
    }

    function exchangePage(){
        view("exchange-guide");
    }

    function mainFestivalPage(){
        view("festival-main");
    }

    function listFestivalPage(){
        view("festival-list", [
            "festivals" => pager(DB::fetchAll("SELECT F.*, IFNULL(E.cnt, 0) cnt
                                                FROM festivals F
                                                LEFT JOIN (SELECT COUNT(*) cnt, fid FROM files GROUP BY fid) E ON E.fid = F.id
                                                ORDER BY F.id DESC"))
        ]);
    }

    function locationPage(){
        require VIEW."/location.php";
    }

    function insertFormPage(){
        view("insert-form");
    }

    function updateFormPage($id){
        $festival = DB::find("festivals", $id);
        if(!$festival) back("존재하지 않는 축제입니다.");

        view("update-form", [
            "festival" => $festival,
            "files" => DB::fetchAll("SELECT * FROM files WHERE fid = ?", [$id])
        ]);
    }

    function festivalInfoPage($id){
        $festival = DB::find("festivals", $id);
        if(!$festival) back("존재하지 않는 축제입니다.");       
        view("/festival-info", [
            "festival" => $festival,
            "files" => DB::fetchAll("SELECT * FROM files WHERE fid = ?", [$id]),
            "reviews" => DB::fetchAll("SELECT * FROM reviews WHERE fid = ?", [$id])
        ]);
    }

    function schedulePage(){
        $year = isset($_GET['year']) ? $_GET['year'] : date("Y");
        $month = isset($_GET['month']) ? $_GET['month'] : date("m");

        $time__first_day = strtotime( "{$year}-{$month}-1" );
        $time__last_day = strtotime("-1 Day", strtotime( "+1 Month", $time__first_day ));
        
        $first_day = date("Y-m-d", $time__first_day);
        $last_day = date("Y-m-d", $time__last_day);

        $time__prev_month = strtotime( "-1 Month", $time__first_day );
        $time__next_month = strtotime( "+1 Month", $time__first_day );

        $schedules = DB::fetchAll("SELECT 
                                        id, name, period,
                                        IF(start_date < ?, 1, DATE_FORMAT(start_date, '%d')) start_date, 
                                        IF(end_date > ?, ?, DATE_FORMAT(end_date, '%d')) end_date
                                    FROM festivals 
                                    WHERE (? BETWEEN start_date AND end_date)
                                    OR (? BETWEEN start_date AND end_date)
                                    OR (start_date BETWEEN ? AND ?)
                                    OR (end_date BETWEEN ? and ?)
                                    ORDER BY start_date ASC, end_date ASC", [
                                        $first_day, $last_day, date("d", $time__last_day),
                                        $first_day, 
                                        $last_day, 
                                        $first_day, $last_day, 
                                        $first_day, $last_day
                                        ]);
        
        view("schedule", compact("time__first_day", "time__last_day", "time__prev_month", "time__next_month", "schedules"));
    }

    /**
     * Actions
     */

    function login(){
        checkEmpty();
        extract($_POST);

        if($user_id !== "admin" || $password !== "admin") back("입력 정보와 일치하는 회원이 없습니다.");
        $_SESSION['user'] = true;
        go("/", "로그인 되었습니다.");
    }

    function logout(){
        unset($_SESSION['user']);
        go("/", "로그아웃 되었습니다.");
    }

    function insertFestival(){
        checkEmpty();
        extract($_POST);       

        if(!preg_match("/^([0-9]{4}-[0-9]{1,2}-[0-9]{1,2}) ~ ([0-9]{4}-[0-9]{1,2}-[0-9]{1,2})$/", $period, $matches))
            back("올바른 축제 기간을 입력해 주세요.");
    
        $start_date = $matches[1];
        $end_date = $matches[2];
        $period = $start_date . " ~ " . date("m-d", strtotime($end_date));
        $no = substr(time(), -5);

        $images = $_FILES['images'];
        for($i = 0; $i < count($images['name']); $i++){
            if(!$images['name'][$i]) continue;
            if(array_search(ext_name($images['name'][$i]), ['.jpg', ".png", ".gif"]) === false)
                back("이미지는 jpg, png, gif 형식만 업로드 할 수 있습니다.");
        }
        
        DB::query("INSERT INTO festivals(no, name, start_date, end_date, period, area, location) VALUES (?, ?, ?, ?, ?, ?, ?)", [
            $no, $name, $start_date, $end_date, $period, $area, $location
        ]);

        $fid = DB::lastInsertId();
        $image_path = "/festivalImages/" . str_pad($fid, 3, "0", STR_PAD_LEFT)."_".$no;
        DB::query("UPDATE festivals SET imagePath = ? WHERE id = ?", [$image_path, $fid]);

        if(!is_dir(ROOT.$image_path))
            mkdir(ROOT.$image_path);
        
        
        for($i = 0; $i < count($images['name']); $i++){
            if(!$images['name']) continue;
            $origin_name = $images['name'][$i];
            $local_name = time()."_".($i + 1).ext_name($origin_name);
            $tmp_name = $images['tmp_name'][$i];
            
            move_uploaded_file($tmp_name, ROOT.$image_path."/$local_name");
            DB::query("INSERT INTO files(fid, origin_name, local_name) VALUES (?, ?, ?)", [$fid, $origin_name, $local_name]);
        }
        
        go("/festival-list", "축제를 등록했습니다.");
    }

    function updateFestival($id){
        checkEmpty();
        extract($_POST);              

        $festival = DB::find("festivals", $id);
        if(!$festival) back("존재하지 않는 축제입니다.");

        if(!preg_match("/^([0-9]{4}-[0-9]{1,2}-[0-9]{1,2}) ~ ([0-9]{4}-[0-9]{1,2}-[0-9]{1,2})$/", $period, $matches))
            back("올바른 축제 기간을 입력해 주세요.");

        $start_date = $matches[1];
        $end_date = $matches[2];
        $period = $start_date . " ~ " . date("m-d", strtotime($end_date));
            
        $images = $_FILES['add_images'];
        for($i = 0; $i < count($images['name']); $i++){
            if(!$images['name'][$i]) continue;
            if(array_search(ext_name($images['name'][$i]), ['.jpg', ".png", ".gif"]) === false)
                back("이미지는 jpg, png, gif 형식만 업로드 할 수 있습니다.");
        }


        DB::query("UPDATE festivals SET start_date = ?, end_date = ?, period = ?, name = ?, area = ?, location = ? WHERE id = ?", [
            $start_date, $end_date, $period, $name, $area, $location, $id
            ]);
        $sql_where = " WHERE id NOT IN (". implode(",", array_fill(0, count($left_images), "?")) . ") AND fid = ?";
        $deleted_files = DB::fetchAll("SELECT * FROM files". $sql_where, [ ...$left_images, $id ]);
        DB::query("DELETE FROM files". $sql_where, [ ...$left_images, $id ]);
        
        foreach($deleted_files as $file){
            $local_path = ROOT.$festival->imagePath."/{$file->local_name}";
            if(is_file($local_path)){
                unlink( $local_path );
            }
        }

        for($i = 0; $i < count($images['name']); $i++){
            if(!$images['name'][$i]) continue;
            $origin_name = $images['name'][$i];
            $local_name = time()."_".($i + 1).ext_name($origin_name);
            $tmp_name = $images['tmp_name'][$i];
            
            move_uploaded_file($tmp_name, ROOT.$festival->imagePath."/$local_name");
            DB::query("INSERT INTO files(fid, origin_name, local_name) VALUES (?, ?, ?)", [$id, $origin_name, $local_name]);
        }

        go("/festival-list", "수정되었습니다.");
    }

    function downloadImage($type, $id){
        $festival = DB::find("festivals", $id);
        if(!$festival) back("존재하지 않는 축제입니다.");           
        if(array_search($type, ["tar", "zip"]) === false) back("올바른 형식을 지정하세요.");
     

        $files = DB::fetchAll("SELECT local_name, origin_name FROM files WHERE fid = ?", [$id]);
        $compact_path = ROOT."/resources/compact/" . time() . ".$type";

        if(count($files) === 0) back("다운로드 할 이미지 파일이 존재하지 않습니다.");

        if($type == "tar"){
            $compacter = new PharData($compact_path);
            foreach($files as $file){
                $filePath = ROOT.$festival->imagePath."/{$file->local_name}";
                $compacter->addFile( $filePath, $file->origin_name );
            }
        } else if($type == "zip"){
            $compacter = new ZipArchive();
            $compacter->open($compact_path, ZipArchive::CREATE);
            foreach($files as $file){
                $filePath = ROOT.$festival->imagePath."/{$file->local_name}";
                $compacter->addFile( $filePath, $file->origin_name );
            }
            $compacter->close();
        }

        header("Content-Disposition: attechment; filename={$festival->name}.{$type}");
        readfile($compact_path);
        unlink($compact_path);
    }

    function deleteFestival($id){
        $festival = DB::find("festivals", $id);
        if(!$festival) back("존재하지 않는 축제입니다.");
        
        DB::query("DELETE FROM festivals WHERE id = ?", [$id]);   
        go("/festival-list", "축제 정보를 삭제했습니다.");
    }

    function insertReview($fid){
        checkEmpty();
        extract($_POST);

        $festival = DB::find("festivals", $fid);
        if(!$festival) back("존재하지 않는 축제입니다.");       


        DB::query("INSERT INTO reviews(fid, user_name, score, content) VALUES (?, ?, ?, ?)", [$festival->id, $user_name, $score, $content]);
        go("/festivals/$fid", "후기가 작성되었습니다.");
    }

    function deleteReview($id){
        $review = DB::find("reviews", $id);
        if(!$review) back("존재하지 않는 후기입니다.");

        DB::query("DELETE FROM reviews WHERE id = ?", [$id]);
        go("/festivals/{$review->fid}", "후기가 삭제되었습니다.");
    }
}