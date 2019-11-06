<?php
namespace Plugin;

class PostType
{
    protected $name;
    protected $args;

    public function __construct(string $file, string $name, array $args)
    {
        $this->name = $name;
        $this->args = $args;
        add_action( 'init',  [$this, 'register'], 3);
        register_activation_hook( $file, [$this, 'flush']);
    }

    public function register()
    {
        register_post_type($this->name, $this->args);
    }

    public function flush()
    {
        $this->register();
        flush_rewrite_rules();
    }

    public function __toString()
    {
        return $this->name;
    }
}
