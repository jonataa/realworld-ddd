<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Create;

use RealWorld\Blog\Article\Domain\ArticleRepository;
use RealWorld\Blog\Article\Domain\Article;

final class ArticleCreator
{

  private $repository;

  public function __construct(ArticleRepository $repository)
  {
    $this->repository = $repository;
  }

  public function __invoke(Article $article): void
  {
    $this->repository->save($article);
  }

}