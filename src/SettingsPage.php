<?php
namespace Plugin;

use StoutLogic\AcfBuilder\FieldsBuilder;

class SettingsPage extends FieldsBuilder
{
    public function __construct(string $slug, string $title, $icon = "dashicons-chart-bar", int $position = 90, string $permission = 'manage_options')
    {
        acf_add_options_page([
            'page_title' 	=> $title,
            'menu_title'	=> $title,
            'menu_slug' 	=> $slug,
            'icon_url'      => $icon,
            'position'      => $position,
            'capability'	=> $permission,
            'redirect'		=> false
        ]);

        parent::__construct($slug, []);
        add_action('acf/init', [$this, 'register']);
        $this->addToOptionPages([$slug]);
    }

    public function addToOptionPages(array $pages)
    {
        for($i = 0; $i < count($pages); $i++)
        {
            if($i == 0)
            {
                $location = $this->setLocation('options_page', '==', $pages[$i]);
            }
            else {
                $location->or('post_type', '==', $pages[$i]);
            }
        }
    }

    public function register()
    {
        acf_add_local_field_group($this->build());
    }
}