<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('site_option')) {
    /**
     * Get a site option from the `settings` table.
     * Returns $default if the table or key does not exist.
     */
    function site_option($key, $default = null)
    {
        $ci = &get_instance();
        if (!isset($ci->db)) return $default;
        if (method_exists($ci->db, 'table_exists') && !$ci->db->table_exists('settings')) return $default;
        $row = $ci->db->where('skey', $key)->get('settings', 1)->row();
        if ($row) return $row->svalue;
        return $default;
    }
}

if (!function_exists('get_menu')) {
    /**
     * Get a menu by name. Expects tables `menus` and `menu_items`.
     * Returns an array of items [ ['title'=>..., 'url'=>..., 'children'=>[] ], ... ]
     */
    function get_menu($name = 'primary')
    {
        $ci = &get_instance();
        if (!isset($ci->db)) return array();
        if (method_exists($ci->db, 'table_exists') && (!$ci->db->table_exists('menus') || !$ci->db->table_exists('menu_items'))) return array();

        $menu = $ci->db->where('menu_name', $name)->get('menus', 1)->row();
        if (!$menu) return array();

        $items = $ci->db->where('menu_id', $menu->id)->order_by('sort_order','ASC')->get('menu_items')->result();
        $tree = array();
        $lookup = array();
        foreach ($items as $it) {
            $node = array(
                'id' => $it->id,
                'title' => $it->title,
                'url' => $it->url,
                'parent_id' => $it->parent_id,
                'children' => array()
            );
            $lookup[$it->id] = $node;
        }
        foreach ($lookup as $id => &$node) {
            if ($node['parent_id'] && isset($lookup[$node['parent_id']])) {
                $lookup[$node['parent_id']]['children'][] = &$node;
            } else {
                $tree[] = &$node;
            }
        }
        return $tree;
    }
}

if (!function_exists('menu_render')) {
    /**
     * Render a menu as HTML list. Used by views to keep markup small.
     */
    function menu_render($items)
    {
        $html = '';
        foreach ($items as $it) {
            $has = (!empty($it['children'])) ? ' has-child' : '';
            $html .= '<li class="' . trim($has) . '">';
            $html .= '<a href="' . htmlspecialchars($it['url']) . '">' . htmlspecialchars($it['title']) . '</a>';
            if (!empty($it['children'])) {
                $html .= '<ul class="child">';
                $html .= menu_render($it['children']);
                $html .= '</ul>';
            }
            $html .= '</li>';
        }
        return $html;
    }
}

    if (!function_exists('get_ctas')) {
        /**
         * Returns ordered CTAs from `ctas` table as array
         */
        function get_ctas()
        {
            $ci = &get_instance();
            if (!isset($ci->db)) return array();
            if (method_exists($ci->db, 'table_exists') && !$ci->db->table_exists('ctas')) return array();
            $rows = $ci->db->order_by('sort_order','ASC')->get('ctas')->result();
            $out = array();
            foreach ($rows as $r) {
                $out[] = array('label'=>$r->label,'url'=>$r->url,'style'=>$r->style,'id'=>$r->id);
            }
            return $out;
        }
    }

    if (!function_exists('get_media')) {
        /**
         * Return media record by id or all media when id is null
         */
        function get_media($id = null)
        {
            $ci = &get_instance();
            if (!isset($ci->db)) return array();
            if (method_exists($ci->db, 'table_exists') && !$ci->db->table_exists('media')) return array();
            if ($id === null) return $ci->db->order_by('date_uploaded','DESC')->get('media')->result();
            return $ci->db->where('id',$id)->get('media',1)->row();
        }
    }
