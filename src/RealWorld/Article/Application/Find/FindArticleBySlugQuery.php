<?php

declare(strict_types = 1);

namespace RealWorld\Article\Application\Find;

use RealWorld\Article\Domain\ArticleSlug;

final class FindArticleBySlugQuery
{

    /** @var ArticleSlug */
    private $slug;

    public function __construct(ArticleSlug $slug)
    {
        $this->slug = $slug;
    }

    public function slug(): ArticleSlug
    {
        return $this->slug;
    }

}