<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model
{
    protected $table = 'pages';

    public function __construct()
    {
        parent::__construct();
    }

    public function get($slug_or_id)
    {
        if (is_numeric($slug_or_id)) {
            return $this->db->where('id', (int)$slug_or_id)->get($this->table, 1)->row();
        }
        return $this->db->where('slug', $this->db->escape_str($slug_or_id))->where('status', 'published')->get($this->table, 1)->row();
    }

    public function get_all()
    {
        return $this->db->order_by('created_at', 'DESC')->get($this->table)->result();
    }

    public function insert($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        // sanitize content to remove basic XSS vectors (allow limited tags)
        if (isset($data['content'])) $data['content'] = $this->sanitize_html($data['content']);
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        if (isset($data['content'])) $data['content'] = $this->sanitize_html($data['content']);
        return $this->db->where('id', (int)$id)->update($this->table, $data);
    }

    /** Basic HTML sanitizer: allow a limited set of tags and remove event handlers and javascript: URIs. Not a full HTMLPurifier replacement. */
    private function sanitize_html($html)
    {
        if ($html === null) return null;
        // Prefer HTMLPurifier if available (recommended). Fall back to simple sanitizer.
        if (class_exists('\HTMLPurifier')) {
            // minimal config: allow commonly used tags and attributes
            $config = \HTMLPurifier_Config::createDefault();
            $config->set('HTML.SafeIframe', true);
            $config->set('URI.SafeIframeRegexp', '%^(https?:)?//(www.youtube.com/embed/|player.vimeo.com/video/)%;');
            $purifier = new \HTMLPurifier($config);
            return $purifier->purify($html);
        }
        // allowed tags
        $allowed = '<p><a><strong><b><em><i><ul><ol><li><br><h1><h2><h3><h4><h5><img><blockquote><pre><code>';
        // strip disallowed tags
        $out = strip_tags($html, $allowed);
        // remove event handler attributes like onclick=
        $out = preg_replace('/on[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $out);
        // remove javascript: in href/src
        $out = preg_replace_callback('/(href|src)\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', function ($m) {
            $attr = $m[1];
            $val = trim($m[2], "'\"");
            if (preg_match('/^javascript:/i', $val)) {
                return "$attr=\"#\"";
            }
            // return cleaned attribute
            return $attr.'="'.htmlspecialchars($val, ENT_QUOTES, 'UTF-8').'"';
        }, $out);
        return $out;
    }

    public function delete($id)
    {
        return $this->db->where('id', (int)$id)->delete($this->table);
    }

    public function slug_exists($slug, $exclude_id = null)
    {
        $this->db->where('slug', $slug);
        if ($exclude_id) $this->db->where('id !=', (int)$exclude_id);
        return $this->db->count_all_results($this->table) > 0;
    }
}
