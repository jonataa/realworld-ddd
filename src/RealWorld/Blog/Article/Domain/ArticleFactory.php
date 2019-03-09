<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Domain;

use RealWorld\Blog\Article\Domain\Article;
use RealWorld\Blog\ArticleAuthor\Domain\ArticleAuthorId;

final class ArticleFactory
{

  public static function createFromArray(array $data): Article
  {
    return new Article(
      new ArticleId($data['id']),
      new ArticleSlug($data['slug']),
      new ArticleTitle($data['title']),
      new ArticleDescription($data['description']),
      new ArticleBody($data['body']),
      new ArticleAuthorId($data['authorId'])
    );
  }

}