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
        return __('Description');
    }

    public function getFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('book');
        $builder
            ->addText('title2')
        ;
        return $builder;
    }
}