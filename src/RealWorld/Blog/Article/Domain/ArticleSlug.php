<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Domain;

use RealWorld\Shared\Domain\ValueObject\StringValueObject;

final class ArticleSlug extends StringValueObject
{

  public function slug(): string
  {
    return $this->value();
  }

}