<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Find;

use RealWorld\Blog\Article\Domain\Article;
use function Lambdish\Phunctional\apply;

final class FindArticleBySlugQueryHandler
{

    protected $finder;

    public function __construct(ArticleFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(FindArticleBySlugQuery $query): Article
    {
        return apply($this->finder, [$query]);
    }

}