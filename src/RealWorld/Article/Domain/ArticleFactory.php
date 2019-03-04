<?php

declare(strict_types = 1);

namespace RealWorld\Article\Domain;

use RealWorld\Article\Domain\Entities\Article;

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