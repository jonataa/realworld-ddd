<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Domain;

final class ArticleSlug
{

  /** @var string */
  private $slug;

  public function __construct(string $slug)
  {
    $this->slug = $slug;
  }

  public function slug(): string
  {
    return $this->slug;
  }

}