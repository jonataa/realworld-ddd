<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Create;

use RealWorld\Blog\Article\Domain\ArticleRepository;
use RealWorld\Blog\Article\Domain\Article;
use RealWorld\Blog\Article\Domain\ArticleId;
use RealWorld\Blog\ArticleAuthor\Domain\ArticleAuthorId;

final class ArticleCreator
{

  private $repository;

  public function __construct(ArticleRepository $repository)
  {
    $this->repository = $repository;
  }

  public function create(ArticleId $id, $slug, $title, $description, $body, ArticleAuthorId $authorId): void
  {
    $article = Article::create($id, $slug, $title, $description, $body, $authorId);

    $this->repository->save($article);
  }

}