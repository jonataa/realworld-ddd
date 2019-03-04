<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Create;

use RealWorld\Shared\Domain\Bus\Command\Command;
use RealWorld\Shared\Domain\ValueObject\Uuid;

final class CreateArticleCommand extends Command
{

  /** @var string */
  private $id;

  /** @var string */
  private $slug;

  /** @var string */
  private $title;

  /** @var string */
  private $description;

  /** @var string */
  private $body;

  /** @var string */
  private $authorId;

  public function __construct(
    Uuid $commandId, 
    string $id,
    string $slug, 
    string $title,
    string $description,
    string $body,
    string $authorId
  ) {
    parent::__construct($commandId);

    $this->id = $id;
    $this->slug = $slug;
    $this->title = $title;
    $this->description = $description;
    $this->body = $body;
    $this->authorId = $authorId;
  }

  public function id(): string
  {
    return $this->id;
  }

  public function slug(): string
  {
    return $this->slug;
  }

  public function title(): string
  {
    return $this->title;
  }

  public function description(): string
  {
    return $this->description;
  }

  public function body(): string
  {
    return $this->body;
  }

  public function authorId(): string
  {
    return $this->authorId;
  }

}