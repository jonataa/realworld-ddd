<?php

namespace RealWorld\Domain;

use RealWorld\Domain\Entities\Article;

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