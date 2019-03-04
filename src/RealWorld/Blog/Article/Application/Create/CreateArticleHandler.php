<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Create;

use function Lambdish\Phunctional\apply;

final class CreateArticleHandler
{

  /** @var ArticleCreator */
  private $creator;

  public function __construct(ArticleCreator $creator)
  {
    $this->creator = $creator;
  }

  public function handle(CreateArticleCommand $command): void
  {
    apply($this->creator, [$command->article()]);
  }

}