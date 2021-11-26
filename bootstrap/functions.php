<?php

use Carbon\Carbon;

function generateLink($url, $text, $target = '_self')
{
    return "<a href='" . $url . "' target='" . $target . "'>" . $text . "</a>";
}

function toOptions($collection, $default = [])
{
    if ($collection->count()) {
        foreach ($collection as $item) {
            $default[$item->id] = $item->text;
        }
    }

    return $default;
}

function weightOptions()
{
    $weight = [];

    for ($i = 0; $i < 10; $i++) {
        array_push($weight, $i);
    }

    return $weight;
}

function array_set(...$args)
{
    return \Illuminate\Support\Arr::set(...$args);
}


function getImageUrl($path, $width = 0, $height = 0, $quality = 90, $type = 1)
{
    $rate = isset($setting['rate']) ?: '1.0';

    $width = $width * $rate;

    $height = $height * $rate;

    $path = trim($path, '/');

    $sign = substr(md5(md5($width . $height . $type . $quality . $path)), 0, 16);

    $url = config('image.host') . '/image/' . $width . 'x' . $height . '/' . $quality . '/' . $type . '/' . $sign . '/' . $path;

    return $url;
}

function getImage($width, $height, $quality, $type, $sign, $path)
{
    return app('Image')->getImage($width, $height, $quality, $type, $sign, $path);
}

function urlImg($path)
{
    return config('image.host') . '/' . $path;
}

function toDate($datetime)
{
    return \Carbon\Carbon::make($datetime)->format('Y-m-d');
}

function genOrderNumber($prefix)
{
    return $prefix . date('ymdHis') . str_pad(rand(0, 99), 2, 0, STR_PAD_LEFT);
}

function payLog($message, $data = [], $level = 'debug')
{
    if (!in_array($level, ['debug', 'info', 'warning', 'error'])) {
        $level = 'info';
    }

    Log::channel('payment')->{$level}($message, $data);
}

function formatTextAreaToList($content)
{
    $list = explode(PHP_EOL, $content);

    $data = [];
    foreach ($list as $row) {
        $data[] = $row;
    }

    return $data;
}

/***
 * 不同HEADER的int值
 * const HEADER_FORWARDED = 0b00001; // When using RFC 7239
 * const HEADER_X_FORWARDED_FOR = 0b00010;
 * const HEADER_X_FORWARDED_HOST = 0b00100;
 * const HEADER_X_FORWARDED_PROTO = 0b01000;
 * const HEADER_X_FORWARDED_PORT = 0b10000;
 * const HEADER_X_FORWARDED_ALL = 0b11110; // All "X-Forwarded-*" headers
 * const HEADER_X_FORWARDED_AWS_ELB = 0b11010; // AWS ELB doesn't send X-Forwarded-Host
 ***/

function getIp()
{
    request()->setTrustedProxies(['REMOTE_ADDR'], 0b00010);
    $ip = array_reverse(request()->getClientIps())[0];
    return $ip;
}

function cleanSpacing($string)
{
    $string = preg_replace('/\xc2\xa0/', ' ', $string);
    $string = preg_replace('/\s+/', '', $string);
    $string = str_replace('&nbsp;', '', $string);
    $string = str_replace(["   ", " ", "　", "\n", "\r", "\t", "&nbsp;"], ["", "", "", "", "", "", ""], $string);
    $string = trim($string);
    return $string;
}


/***
 *
 * get days between start date and end date
 * @param $start
 * @param $end
 * @return array
 */
function getDays($start, $end)
{
    $result = [];
    while ($start <= $end) {
        $result[] = $start;
        $start = Carbon::createFromFormat('Y-m-d', $start)->addDay()->format('Y-m-d');
    }
    return $result;
}


function validate_ip($ip)
{
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6) === false) {
        return false;
    }
    return true;
}

function generateSlug($string, $delimiter = '-')
{
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array('&' => 'and', "'" => '');
    $string = mb_strtolower(trim($string), 'UTF-8');
    $string = str_replace(array_keys($special_cases), array_values($special_cases), $string);
    $string = preg_replace($accents_regex, '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
    $string = preg_replace("/[^a-z0-9]/u", "$delimiter", $string);
    $string = preg_replace("/[$delimiter]+/u", "$delimiter", $string);

    return $string;
}

function theme_dir($site, $file)
{
    return '/build/' . $site->theme->name . '/' . $file;
}

function getHeaderMenus($site)
{
    return \App\Models\GroupSiteMenu::getMenus($site, \App\Models\GroupSiteMenu::POSITION_HEADER);
}

function getFooterMenus($site)
{
    return \App\Models\GroupSiteMenu::getMenus($site, \App\Models\GroupSiteMenu::POSITION_FOOTER);
}

