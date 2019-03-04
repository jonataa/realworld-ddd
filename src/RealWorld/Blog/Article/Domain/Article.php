<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Domain;

use RealWorld\Blog\ArticleAuthor\Domain\ArticleAuthorId;

final class Article
{

    /** @var ArticleId */
    protected $id;

    /** @var string */
    protected $slug;

    /** @var string */
    protected $title;

    /** @var string */
    protected $description;

    /** @var string */
    protected $body;

    /** @var TagCollection */
    protected $tags;

    /** @var bool */
    protected $favorited;

    /** @var ArticleAuthorId */
    protected $authorId;

    public function __construct(
        ArticleId $id,
        string $slug,   
        string $title, 
        string $description,
        string $body,
        ArticleAuthorId $authorId
    ) {
        $this->id = $id;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->body = $body;
        $this->authorId = $authorId;
    }

    public static function create(
        ArticleId $id, 
        $slug, 
        $title, 
        $description, 
        $body, 
        ArticleAuthorId $authorId
    ): self 
    {
        return new self($id, $slug, $title, $description, $body, $authorId);
    }
    
    public function id(): ArticleId
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

    public function tags(): TagCollection
    {
        return $this->tags;
    }

    public function favorite(): void
    {
        $this->favorited = true;
    }

    public function unfavorite(): void
    {
        $this->favorited = false;
    }

    public function isFavorited(): bool
    {
        return $this->favorited;
    }

}