<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Domain;

use RealWorld\Blog\Article\Domain\Article;
use RealWorld\Blog\Article\Domain\ArticleSlug;

interface ArticleRepository
{

    public function searchBySlug(ArticleSlug $slug): ?Article;

}