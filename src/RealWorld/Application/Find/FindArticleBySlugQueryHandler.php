<?php

declare(strict_types = 1);

namespace RealWorld\Application\Find;

use RealWorld\Domain\Entities\Article;
use function Lambdish\Phunctional\apply;

final class FindArticleBySlugQueryHandler
{

    protected $finder;

    public function __construct(ArticleFinder $finder)
    {
        $this->finder = $finder;
    }

    public function handle(FindArticleBySlugQuery $query): Article
    {
        return apply($this->finder, [$query]);
    }

}