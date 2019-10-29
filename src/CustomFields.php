<?php
namespace Plugin;

use StoutLogic\AcfBuilder\FieldsBuilder;

class CustomFields extends FieldsBuilder
{
    public function __construct($name, array $groupConfig = [], array $postTypes = [])
    {
        parent::__construct($name, $groupConfig);
        add_action('acf/init', [$this, 'register']);
        if(count($postTypes))
        {
            $this->addToPostTypes($postTypes);
        }
    }

    public function addToPostTypes(array $types)
    {
        for($i = 0; $i < count($types); $i++)
        {
            if($i == 0)
            {
                $location = $this->setLocation('post_type', '==', $types[$i]);
            }
            else {
                $location->or('post_type', '==', $types[$i]);
            }
        }
    }

    public function register()
    {
        acf_add_local_field_group($this->build());
    }
}