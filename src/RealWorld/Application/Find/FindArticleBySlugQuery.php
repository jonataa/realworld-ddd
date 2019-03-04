<?php

declare(strict_types = 1);

namespace RealWorld\Application\Find;

final class FindArticleBySlugQuery
{
    
    /** @var string */
    private $slug;
    
    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }
    
    public function slug(): string
    {
        return $this->slug;
    }
    
}