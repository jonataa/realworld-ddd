<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Create;

use RealWorld\Blog\ArticleAuthor\Domain\ArticleAuthorId;
use RealWorld\Blog\Article\Domain\ArticleId;

final class CreateArticleHandler
{

  /** @var ArticleCreator */
  private $creator;

  public function __construct(ArticleCreator $creator)
  {
    $this->creator = $creator;
  }

  public function __invoke(CreateArticleCommand $command): void
  { 
    $id          = new ArticleId($command->id());
    $slug        = $command->slug();
    $title       = $command->title();
    $description = $command->description();
    $body        = $command->body();
    $authorId    = new ArticleAuthorId($command->authorId());
    
    $this->creator->create($id, $slug, $title, $description, $body, $authorId);
  }

}