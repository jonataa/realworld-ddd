<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Infrastructure\Persistence;

use RealWorld\Blog\Article\Domain\Article;
use RealWorld\Blog\Article\Domain\ArticleSlug;

interface ArticleRepository
{

    public function findOneBySlug(ArticleSlug $slug): ?Article;

}