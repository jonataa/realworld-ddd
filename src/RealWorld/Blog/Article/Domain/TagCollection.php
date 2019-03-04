<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Domain;

final class TagCollection
{

    /** @var string[] */
    protected $collection = [];

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
     * Add item to collection.
     *
     * @param string $item
     * @return void
     */
    public function add(string $item): void
    {
        $this->collection[] = $item;
    }

    /**
     * Get all tags as array of strings.
     *
     * @return string[]
     */
    public function toArray()
    {
        return $this->collection;
    }

}