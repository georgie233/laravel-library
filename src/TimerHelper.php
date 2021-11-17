<?php


namespace Georgie\Utils;


class TimerHelper
{
    /**
     * 当前时间
     * @param string $format 格式
     * @return false|string
     */
    public static function getData($format = "Y-m-d H:i:s")
    {
        date_default_timezone_set('Asia/Shanghai');
        return date($format, time());
    }

    /**
     * 当前时间戳
     * @return false|string
     */
    public static function getTime()
    {
        date_default_timezone_set('Asia/Shanghai');
        return time();
    }

    /**
     * 毫秒时间
     * @return false|string
     */
    public static function getUDate()
    {
        date_default_timezone_set('Asia/Shanghai');
        $msec = 0;
        list($msec, $sec) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    }

    /**
     *  计算两个时间差
     * @param string $end_time 结束时间
     * @param string $start_time 开始时间
     * @param string $type day hour minute
     * @return false|int
     */
    public static function getTimeDifference($end_time, $start_time, $type = 'time')
    {
        date_default_timezone_set('Asia/Shanghai');
        $end_time = strtotime($end_time);
        $start_time = $start_time == '' ? strtotime(self::getData('Y-m-d H:i:s')) : strtotime($start_time);
        if ($type === 'day') floor($end_time - $start_time / 86400);
        if ($type === 'hour') floor($end_time - $start_time % 86400 / 3600);
        if ($type === 'minute') floor($end_time - $start_time % 86400 / 60);
        return $end_time - $start_time;
    }

    protected static function numAddChar($num, $char, $bool = true)
    {
        if (!$bool) return '';
        $num = $num * 1;
        return $num ? $num . $char : '';
    }

    /**
     *  计算两个时间差 返回数组
     * @param string $end_time 结束时间
     * @param string $start_time 开始时间
     * @param string $type
     * @return false|array
     */
    public static function getTimeDifferenceArr($end_time, $start_time, $type = "YmdHis")
    {
        $strtoDateOne = strtotime($end_time);
        $strtoDateTwo = strtotime($start_time);

        if ($strtoDateOne < $strtoDateTwo) {
            $tmp = $strtoDateTwo;
            $strtoDateTwo = $strtoDateOne;
            $strtoDateOne = $tmp;
        }
        $dateMonthOne = explode('-', date('Y-m', $strtoDateOne));
        $dateMonthTwo = explode('-', date('Y-m', $strtoDateTwo));
        $date = date('Y-m-d H:i:s', $strtoDateOne - $strtoDateTwo);
        $arr = explode("-", $date);
        $arr2 = explode(":", $arr[2]);
        $arr[0] -= 1970;
        $arr[2] = explode(" ", $arr[2])[0];
        $arr2[0] = explode(" ", $arr2[0])[1];

        $str = self::numAddChar($arr[0], '年', substr_count(strtolower($type), 'y'))
            . self::numAddChar($arr[1], '月', substr_count(strtolower($type), 'm'))
            . self::numAddChar($arr[2], '天', substr_count(strtolower($type), 'd'));
        $str2 = self::numAddChar($arr2[0], '小时', substr_count(strtolower($type), 'h'))
            . self::numAddChar($arr2[1], '分钟', substr_count(strtolower($type), 'i'))
            . self::numAddChar($arr2[2], '秒', substr_count(strtolower($type), 's'));
        return ($str . $str2);
    }

    /**
     * 将指定日期转换为时间戳
     * @param string $date
     * @return false|int
     */
    public static function dateToTimestamp($date)
    {
        date_default_timezone_set('Asia/Shanghai');
        return strtotime($date);
    }

    /**
     * 获取某个时间之后的时间
     * @param string $format 格式
     * @param int $mun 多少分钟
     * @return false|string
     */
    public static function dateRear($format = "Y-m-d H:i:s", $mun = 10)
    {
        date_default_timezone_set('Asia/Shanghai');
        return date($format, strtotime(self::getData()) + $mun);
    }

    /**
     * 获取某个时间之前的时间
     * @param string $format 格式
     * @param int $mun 多少分钟
     * @return false|string
     */
    public static function dateBefore($format = "Y-m-d H:i:s", $mun = 10)
    {
        date_default_timezone_set('Asia/Shanghai');
        return date($format, strtotime(self::getData()) - $mun);
    }

    /**
     * 判断当前的时分是否在指定的时间段内
     * @param $start
     * @param $end
     * @return int   1：在范围内，0:没在范围内
     */
    public static function checkIsBetweenTime($start, $end)
    {
        date_default_timezone_set('Asia/Shanghai');
        $date = date('H:i');
        $curTime = strtotime($date);//当前时分
        $assignTime1 = strtotime($start);//获得指定分钟时间戳，00:00
        $assignTime2 = strtotime($end);//获得指定分钟时间戳，01:00
        $result = 0;
        if ($curTime > $assignTime1 && $curTime < $assignTime2) $result = 1;
        return $result;
    }
}
