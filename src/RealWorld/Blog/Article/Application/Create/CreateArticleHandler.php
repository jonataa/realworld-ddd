<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Create;

use function Lambdish\Phunctional\apply;

final class CreateArticleHandler
{

  /** @var callable */
  private $creator;

  public function __construct(ArticleCreator $creator)
  {
    $this->creator = $creator;
  }

  public function __invoke(CreateArticleCommand $command): void
  {
    apply($this->creator, [$command->article()]);
  }

}