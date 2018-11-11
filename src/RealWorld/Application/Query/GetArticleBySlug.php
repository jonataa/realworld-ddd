<?php

namespace RealWorld\Application\Query;

use RealWorld\Infrastructure\Repository\ArticleArrayRepository;
use RealWorld\Domain\Entities\Article;

final class GetArticleBySlug
{

  protected $repository;

  public function __construct(ArticleArrayRepository $repository)
  {
    $this->repository = $repository;
  }

  public function handle(string $slug): ?Article
  {
    return $this->repository->findOneBySlug($slug);
  }

}