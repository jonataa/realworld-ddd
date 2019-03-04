<?php

declare(strict_types = 1);

namespace RealWorld\Article\Infrastructure\Repository;

use RealWorld\Article\Domain\Entities\Article;
use RealWorld\Article\Domain\ArticleSlug;

interface ArticleRepository
{

    public function findOneBySlug(ArticleSlug $slug): ?Article;

}