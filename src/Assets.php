<?php
namespace Plugin;

class Assets
{
    protected $scripts = [];
    protected $styles = [];

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, "register"]);
    }

    public function register()
    {
        foreach($this->scripts as $script) {
            wp_enqueue_script($script);
        }
        foreach($this->styles as $style) {
            wp_enqueue_style($style);
        }
    }

    public function addStyle($handle, $src, $deps = [], $version = false, $media = 'all')
    {
        wp_register_style($handle, $src, $deps, $version ?: time(), $media);
        $this->styles[] = $handle;
    }

    public function addScript($handle, $src, $deps = [], $version = false, $in_footer = true)
    {
        wp_register_script($handle, $src, $deps, $version ?: time(), $in_footer);
        $this->scripts[] = $handle;
    }
}