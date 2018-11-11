<?php

declare(strict_types=1);

namespace RealWorld\Domain\Entities;

final class Article
{

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

    /** @var Profile */
    protected $author;

    public function __construct(   
        string $slug,   
        string $title, 
        string $description,
        string $body
    ) {
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->body = $body;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setTags(TagCollection $tags): void
    {
        $this->tags = $tags;
    }

    public function getTags(): TagCollection
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

    public function setAuthor(Profile $author): void
    {
        $this->author = $author;
    } 

    public function getAuthor(): Profile
    {
        return $this->author;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

}