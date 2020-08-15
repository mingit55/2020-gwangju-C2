<?php
namespace Controller;

use App\DB;

class ApiController {
    /**
     * Response
     */
    function jsonExchangeRate(){
        header("Content-Type: application/json");
        echo '{"items" : [{"result":0,"cur_unit":"AED","ttb":"321.48","tts":"327.97","deal_bas_r":"324.73","bkpr":"324","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"324","kftc_deal_bas_r":"324.73","cur_nm":"아랍에미리트 디르함"},{"result":1,"cur_unit":"AUD","ttb":"807.42","tts":"823.73","deal_bas_r":"815.58","bkpr":"815","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"815","kftc_deal_bas_r":"815.58","cur_nm":"호주 달러"},{"result":1,"cur_unit":"BHD","ttb":"3,127.31","tts":"3,190.48","deal_bas_r":"3,158.9","bkpr":"3,158","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"3,158","kftc_deal_bas_r":"3,158.9","cur_nm":"바레인 디나르"},{"result":1,"cur_unit":"BND","ttb":"847.41","tts":"864.52","deal_bas_r":"855.97","bkpr":"855","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"855","kftc_deal_bas_r":"855.97","cur_nm":"브루나이 달러"},{"result":1,"cur_unit":"CAD","ttb":"866.03","tts":"883.52","deal_bas_r":"874.78","bkpr":"874","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"874","kftc_deal_bas_r":"874.78","cur_nm":"캐나다 달러"},{"result":1,"cur_unit":"CHF","ttb":"1,250.92","tts":"1,276.19","deal_bas_r":"1,263.56","bkpr":"1,263","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"1,263","kftc_deal_bas_r":"1,263.56","cur_nm":"스위스 프랑"},{"result":1,"cur_unit":"CNH","ttb":"167.15","tts":"170.52","deal_bas_r":"168.84","bkpr":"168","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"168","kftc_deal_bas_r":"168.84","cur_nm":"위안화"},{"result":1,"cur_unit":"DKK","ttb":"178.92","tts":"182.53","deal_bas_r":"180.73","bkpr":"180","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"180","kftc_deal_bas_r":"180.73","cur_nm":"덴마아크 크로네"},{"result":1,"cur_unit":"EUR","ttb":"1,333.73","tts":"1,360.68","deal_bas_r":"1,347.21","bkpr":"1,347","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"1,347","kftc_deal_bas_r":"1,347.21","cur_nm":"유로"},{"result":1,"cur_unit":"GBP","ttb":"1,485.53","tts":"1,515.54","deal_bas_r":"1,500.54","bkpr":"1,500","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"1,500","kftc_deal_bas_r":"1,500.54","cur_nm":"영국 파운드"},{"result":1,"cur_unit":"HKD","ttb":"152.36","tts":"155.43","deal_bas_r":"153.9","bkpr":"153","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"153","kftc_deal_bas_r":"153.9","cur_nm":"홍콩 달러"},{"result":1,"cur_unit":"IDR(100)","ttb":"8.42","tts":"8.59","deal_bas_r":"8.51","bkpr":"8","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"8","kftc_deal_bas_r":"8.51","cur_nm":"인도네시아 루피아"},{"result":1,"cur_unit":"JPY(100)","ttb":"1,105.74","tts":"1,128.07","deal_bas_r":"1,116.91","bkpr":"1,116","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"1,116","kftc_deal_bas_r":"1,116.91","cur_nm":"일본 옌"},{"result":1,"cur_unit":"KRW","ttb":"0","tts":"0","deal_bas_r":"1","bkpr":"1","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"1","kftc_deal_bas_r":"1","cur_nm":"한국 원"},{"result":1,"cur_unit":"KWD","ttb":"3,840.22","tts":"3,917.81","deal_bas_r":"3,879.02","bkpr":"3,879","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"3,879","kftc_deal_bas_r":"3,879.02","cur_nm":"쿠웨이트 디나르"},{"result":1,"cur_unit":"MYR","ttb":"277.88","tts":"283.49","deal_bas_r":"280.69","bkpr":"280","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"280","kftc_deal_bas_r":"280.69","cur_nm":"말레이지아 링기트"},{"result":1,"cur_unit":"NOK","ttb":"122.61","tts":"125.08","deal_bas_r":"123.85","bkpr":"123","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"123","kftc_deal_bas_r":"123.85","cur_nm":"노르웨이 크로네"},{"result":1,"cur_unit":"NZD","ttb":"757.64","tts":"772.95","deal_bas_r":"765.3","bkpr":"765","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"765","kftc_deal_bas_r":"765.3","cur_nm":"뉴질랜드 달러"},{"result":1,"cur_unit":"SAR","ttb":"314.73","tts":"321.08","deal_bas_r":"317.91","bkpr":"317","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"317","kftc_deal_bas_r":"317.91","cur_nm":"사우디 리얄"},{"result":1,"cur_unit":"SEK","ttb":"126.5","tts":"129.05","deal_bas_r":"127.78","bkpr":"127","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"127","kftc_deal_bas_r":"127.78","cur_nm":"스웨덴 크로나"},{"result":1,"cur_unit":"SGD","ttb":"847.41","tts":"864.52","deal_bas_r":"855.97","bkpr":"855","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"855","kftc_deal_bas_r":"855.97","cur_nm":"싱가포르 달러"},{"result":1,"cur_unit":"THB","ttb":"38","tts":"38.77","deal_bas_r":"38.39","bkpr":"38","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"38","kftc_deal_bas_r":"38.39","cur_nm":"태국 바트"},{"result":1,"cur_unit":"USD","ttb":"1,180.87","tts":"1,204.72","deal_bas_r":"1,192.8","bkpr":"1,192","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"1,192","kftc_deal_bas_r":"1,192.8","cur_nm":"미국 달러"}]}';
    }

    function jsonFestivalList(){
        json_response([
            "festivals" => array_map(function($item){
                $item->images = array_map(function($item){
                    return $item->local_name;
                }, DB::fetchAll("SELECT * FROM files WHERE fid = ?", [$item->id]));
                return $item;
            }, DB::fetchAll("SELECT * FROM festivals"))
        ]);
    }

    function jsonFestivalByDate(){
        if(!isset($_GET['searchType']) || !isset($_GET['year'])) return;
        if(array_search($_GET['searchType'], ['M', 'Y']) === false || preg_match("/[0-9]{4}/", $_GET['year']) == false) return;
        
        $search_type =  $_GET['searchType'];
        $year = $_GET['year'];
        $month = isset($_GET['month']) && is_numeric($_GET['month']) && $_GET['month'] >= 1 && $_GET['month'] <= 12 ? $_GET['month'] : null;

        // Month
        if($search_type == "M"){
            $first_date = "{$year}-{$month}-1";
            $last_date = date("Y-m-d", strtotime("-1 Day", strtotime("+1 Month", strtotime($first_date))));
        } 
        // Year
        else {
            $first_date = "{$year}-1-1";
            $last_date = "{$year}-12-31";
        }
        
        
        $sql = "SELECT
                    id sn,
                    no,
                    name nm,
                    location,
                    CONCAT( DATE_FORMAT(start_date, '%Y-%m-%d'), '~', DATE_FORMAT(end_date, '%m-%d') ) dt,
                    content cn
                FROM festivals
                WHERE (? BETWEEN start_date AND end_date)
                OR (? BETWEEN start_date AND end_date)
                OR (start_date BETWEEN ? AND ?)
                OR (end_date BETWEEN ? and ?)";
        $items = array_map(function($item){
            $item->images = array_map(function($image){
                return (object)["image" => $image->origin_name];
            }, DB::fetchAll("SELECT * FROM files WHERE fid = ?", [$item->sn]));
            return $item;
        }, DB::fetchAll($sql, [$first_date, $last_date, $first_date, $last_date, $first_date, $last_date]));
        
        json_response([
            "searchType" => $search_type,
            "year" => $year,
            "month" => $month,
            "totalCount" => count($items),
            "items" => $items
        ]);
    }


    /**
     * Insert
     */
    function initialFestivals(){
        DB::query("DELETE FROM festivals");
        DB::query("DELETE FROM files");

        $xml = simplexml_load_file(ROOT."/resources/xml/festivalList.xml");
        foreach($xml->items->item as $item){
            $item->dt = str_replace(".", "-", $item->dt);
            $period_arr = explode("~", $item->dt);
            $start_date = $period_arr[0];
            $end_date = substr($start_date, 0, 4)."-".$period_arr[1];
            $imagePath = "/festivalImages/" . str_pad($item->sn, 3, "0", STR_PAD_LEFT)."_".$item->no;

            DB::query("INSERT INTO festivals(id, no, name, content, area, location, period, start_date, end_date, imagePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                $item->sn, $item->no, $item->nm, $item->cn, $item->area, $item->location, $item->dt, $start_date, $end_date, $imagePath
            ]);
            $fid = DB::lastInsertId();

            foreach($item->images->image as $image){
                if(is_file(ROOT.$imagePath."/$image")){
                    DB::query("INSERT INTO files(fid, origin_name, local_name) VALUES (?, ?, ?)", [$fid, $image, $image]);
                }
            }

            dump($item->nm." 업로드 완료");
        }       
    }
}