<?php
if (!function_exists("home_news")) {
    function home_news()
    {
        $ci = &get_instance();
        $query = "SELECT * FROM news ORDER BY published DESC LIMIT 4";
        $result = $ci->db->query($query)->result();
        return $result;
    }
}
if (!function_exists("homeSlides")) {
    function homeSlides()
    {
        $ci = &get_instance();
        $query = "SELECT * FROM slides ORDER BY date DESC";
        $result = $ci->db->query($query)->result();
        return $result;
    }
}
if (!function_exists("gallery_tags")) {
    function gallery_tags()
    {
        $ci = &get_instance();
        $query = "SELECT * FROM gallery_tags ORDER BY `tag_name`";
        $result = $ci->db->query($query)->result();
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