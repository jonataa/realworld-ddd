<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Create;

use RealWorld\Blog\ArticleAuthor\Domain\ArticleAuthorId;
use RealWorld\Blog\Article\Domain\ArticleId;
use RealWorld\Blog\Article\Domain\ArticleSlug;
use RealWorld\Blog\Article\Domain\ArticleTitle;
use RealWorld\Blog\Article\Domain\ArticleDescription;
use RealWorld\Blog\Article\Domain\ArticleBody;

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
    $slug        = new ArticleSlug($command->slug());
    $title       = new ArticleTitle($command->title());
    $description = new ArticleDescription($command->description());
    $body        = new ArticleBody($command->body());
    $authorId    = new ArticleAuthorId($command->authorId());
    
    $this->creator->create($id, $slug, $title, $description, $body, $authorId);
  }

}