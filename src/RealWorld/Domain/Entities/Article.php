<?php

namespace RealWorld\Domain\Entities;

final class Article
{

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

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
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

    public function setFavorited(bool $favorited): void
    {
        $this->favorited = $favorited;
    }

    public function isFavorited(): bool
    {
        return $this->favorited;
    }

    public function setAuthor(Profile $author): void
    {
        $this->author = $author;
    }

    public function getAuthro(): Profile
    {
        return $this->author;
    }

}