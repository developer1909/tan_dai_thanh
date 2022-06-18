<?php
namespace App\Helpers;

use Carbon\Carbon;
use Victorybiz\GeoIPLocation\GeoIPLocation;

class Helpers
{
    public static function getByColumn($table, $column, $value, $columnsSelected = array('*')) {
        $data = \Illuminate\Support\Facades\DB::table($table)->select($columnsSelected)->where($column, $value)->first();
        if ($data) {
            return $data;
        }
        return null;
    }
    public static function dataSuccess($mes, $data = [])
    {
        return response()->json([
            'success' => true,
            'message' => $mes,
            'data' => $data,
            'code' => 200
        ], 200);
    }

    public static function dataError($mes, $data = [],$code = 202)
    {
        return response()->json([
            'success' => false,
            'message' => $mes,
            'data' => $data,
            'code' => $code
        ], 200);
    }

    public static function dataAdd($mes, $data = [],$code = 200)
    {
        return response()->json([
            'success' => false,
            'message' => $mes,
            'data' => $data,
            'code' => $code
        ], 200);
    }

    public static function convertDate($date, $format_form = 'd/m/Y', $format_to = 'm/d/Y'){
        if(empty($date)){
            return '';
        }
        $start_time = date_create_from_format($format_form, $date);
        return $start_time->format($format_to);
    }

    public static function getTimeZoneSystem()
    {
        $date = date_create(Carbon::now(), timezone_open(config('app.timezone')));
        $timezone = date_format($date, 'P');
        return $timezone;
    }
    public static function getTimeZone()
    {
        // echo "<pre/>";print_r($_SERVER);die;
        if($_SERVER['REMOTE_ADDR'] == "127.0.0.1"){
            $ip = '27.64.56.64';
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];  //$_SERVER['REMOTE_ADDR']
        }
        $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
        $ipInfo = json_decode($ipInfo);
        $timezone = $ipInfo->timezone;
        $date = date_create(Carbon::now(), timezone_open($timezone == "Africa/Niger_State" ? 'UTC' : $timezone));
        $timezone = date_format($date, 'P');
        return $timezone;

    }
}


?>

