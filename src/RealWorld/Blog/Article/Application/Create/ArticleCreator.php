<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Create;

use RealWorld\Blog\Article\Domain\ArticleRepository;
use RealWorld\Blog\ArticleAuthor\Domain\ArticleAuthorId;
use RealWorld\Blog\Article\Domain\Article;
use RealWorld\Blog\Article\Domain\ArticleId;
use RealWorld\Blog\Article\Domain\ArticleSlug;
use RealWorld\Blog\Article\Domain\ArticleTitle;
use RealWorld\Blog\Article\Domain\ArticleDescription;
use RealWorld\Blog\Article\Domain\ArticleBody;

final class ArticleCreator
{

  /** @var ArticleRepository */
  private $repository;

  public function __construct(ArticleRepository $repository)
  {
    $this->repository = $repository;
  }

  public function create(
    ArticleId $id, 
    ArticleSlug $slug, 
    ArticleTitle $title, 
    ArticleDescription $description, 
    ArticleBody $body, 
    ArticleAuthorId $authorId
  ): void {
    $article = Article::create($id, $slug, $title, $description, $body, $authorId);

    $this->repository->save($article);
  }

}