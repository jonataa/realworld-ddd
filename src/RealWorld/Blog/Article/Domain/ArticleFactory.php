<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Domain;

use RealWorld\Blog\Article\Domain\Article;

final class ArticleFactory
{

  public static function createFromArray(array $data): Article
  {
    $article = new Article(
      $data['slug'], 
      $data['title'], 
      $data['description'], 
      $data['body']
    );

    return $article;
  }

}