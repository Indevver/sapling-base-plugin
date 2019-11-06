<?php
namespace Plugin;

class Taxonomy
{
    protected $name;
    protected $args;
    protected $postType;

    public function __construct(string $file, string $postType, string $name, array $args)
    {
        $this->name = $name;
        $this->args = $args;
        $this->postType = $postType;
        add_action( 'init',  [$this, 'register'], 3);
        register_activation_hook( $file, [$this, 'flush']);
    }

    public function register()
    {
        register_taxonomy($this->name, $this->postType, $this->args);
    }

    public function flush()
    {
        $this->register();
        flush_rewrite_rules();
    }
}
