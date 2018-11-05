<?php

namespace RealWorld\Domain\Entities;

final class TagCollection
{

    /** @var array<string> */
    protected $collection = [];

    public function __construct(array $collection)
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
     * @return array<string>
     */
    public function toArray(): array
    {
        return $this->collection;
    }

}