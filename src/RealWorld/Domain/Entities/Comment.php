<?php

namespace RealWorld\Domain\Entities;

final class Comment
{

    /** @var string */
    protected $body;

    /** @var Profile */
    protected $author;

    public function setBody(string $body): void
    {
        $this->body = $body;
    }
    
    public function getBody(): string
    {
        return $this->body;
    }

    public function setAuthor(Profile $author): void
    {
        $this->author = $author;
    } 

    public function getAuthor(): Profile
    {
        return $this->author;
    }

}