<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Domain;

use RealWorld\Blog\ArticleAuthor\Domain\ArticleAuthorId;

final class Article
{

    /** @var ArticleId */
    protected $id;

    /** @var ArticleSlug */
    protected $slug;

    /** @var ArticleTitle */
    protected $title;

    /** @var ArticleDescription */
    protected $description;

    /** @var ArticleBody */
    protected $body;

    /** @var TagCollection */
    protected $tags;

    /** @var bool */
    protected $favorited;

    /** @var ArticleAuthorId */
    protected $authorId;

    public function __construct(
        ArticleId $id,
        ArticleSlug $slug,   
        ArticleTitle $title, 
        ArticleDescription $description,
        ArticleBody $body,
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
        ArticleSlug $slug, 
        ArticleTitle $title, 
        ArticleDescription $description, 
        ArticleBody $body,
        ArticleAuthorId $authorId
    ): self {
        return new self($id, $slug, $title, $description, $body, $authorId);
    }
    
    public function id(): ArticleId
    {
        return $this->id;
    }
    
    public function slug(): ArticleSlug
    {
        return $this->slug;
    }

    public function title(): ArticleTitle
    {
        return $this->title;
    }

    public function description(): ArticleDescription
    {
        return $this->description;
    }

    public function body(): ArticleBody
    {
        return $this->body;
    }

    public function authorId(): ArticleAuthorId
    {
        return $this->authorId;
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