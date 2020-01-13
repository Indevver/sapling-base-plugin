<?php
namespace Plugin\Blocks;

use Sapling\Plugin\Blocks\AbstractBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Book extends AbstractBlock
{

    public function getName(): string
    {
        return 'book';
    }

    public function getTitle(): string
    {
        return __('Book');
    }

    public function getDescription(): string
    {
        return __('Description of book');
    }

    public function getFields(): FieldsBuilder
    {
        // note the name cannot conflict with the fields for the post type
        $builder = new FieldsBuilder('book_block');
        $builder
            ->addText('title')
            ->addWysiwyg('content')
        ;
        return $builder;
    }
}