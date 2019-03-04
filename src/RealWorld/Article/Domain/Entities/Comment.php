<?php

declare(strict_types = 1);

namespace RealWorld\Article\Domain\Entities;

final class Comment
{

    /** @var string */
    protected $body;

    /** @var Profile */
    protected $author;

    public function __construct(string $body, Profile $author)
    {
        $this->body = $body;
        $this->author = $author;
    }
    
    public function getBody(): string
    {
        return $this->body;
    }

    public function getAuthor(): Profile
    {
        return $this->author;
    }

}