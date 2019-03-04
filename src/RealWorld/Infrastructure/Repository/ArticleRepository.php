<?php

namespace RealWorld\Infrastructure\Repository;

use RealWorld\Domain\Entities\Article;

interface ArticleRepository
{

  public function findOneBySlug(string $slug): ?Article;

}