<?php
if (!function_exists("home_news")) {
    function home_news()
    {
        $ci = &get_instance();
        // use Query Builder to avoid raw queries and injection risks
        $result = $ci->db->order_by('published', 'DESC')->limit(4)->get('news')->result();
        return $result;
    }
}
if (!function_exists("homeSlides")) {
    function homeSlides()
    {
        $ci = &get_instance();
        $result = $ci->db->order_by('date', 'DESC')->get('slides')->result();
        return $result;
    }
}
if (!function_exists("gallery_tags")) {
    function gallery_tags()
    {
        $ci = &get_instance();
        $result = $ci->db->order_by('tag_name', 'ASC')->get('gallery_tags')->result();
        return $result;
    }
}
if (!function_exists('neatDate')) {
    function neatDate($dt)
    {
        $bdate = $dt;
        $bdate = str_replace('/', '-', $bdate);
        $nice_date = date('d M., Y', strtotime($bdate));
        return $nice_date;
    }
}

if (!function_exists('neatTime')) {
    function neatTime($dt)
    {
        $bdate = $dt;
        $bdate = str_replace('/', '-', $bdate);
        $nice_date = date('g:i a', strtotime('+1 hour', strtotime($bdate)));
        return $nice_date;
    }
}