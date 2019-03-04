<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Find;

use RealWorld\Blog\Article\Domain\ArticleSlug;
use RealWorld\Shared\Domain\Bus\Query\Query;
final class FindArticleBySlugQuery implements Query
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