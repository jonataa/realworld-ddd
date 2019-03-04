<?php

declare(strict_types = 1);

namespace RealWorld\Blog\ArticleAuthor\Domain;

final class ArticleAuthor
{

  /** @var ArticleAuthorId */
  private $id;

  /** @var ArticleAuthorName */
  private $name;

  public function __construct(ArticleAuthorId $id, ArticleAuthorName $name)
  {
    $this->id = $id;
    $this->name = $name;
  }

  public function id(): ArticleAuthorId
  {
    return $this->id;
  }

  public function name(): ArticleAuthorName
  {
    return $this->name;
  }

}