<?php
namespace Plugin\Blocks;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Book extends FieldsBuilder
{
    public function __construct()
    {
        parent::__construct('plugin_book', ['label' => 'Book']);
        $this->addTab('Content')
            ->addText('title')->setDefaultValue('example title')
            ->addPostObject('book' , ['post_type' => "book"])
        ;
    }
}