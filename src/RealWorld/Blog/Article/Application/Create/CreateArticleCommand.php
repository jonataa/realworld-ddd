<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Create;

use RealWorld\Blog\Article\Domain\Article;

final class CreateArticleCommand
{

  /** @var Article */
  private $article;

  public function __construct(Article $article)
  {
    $this->article = $article;
  }

  public function article(): Article
  {
    return $this->article;
  }

}