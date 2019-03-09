<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Domain;

use RealWorld\Blog\Article\Domain\ArticleSlug;
use RealWorld\Shared\Domain\DomainError;

class ArticleSlugNotFound extends DomainError
{

    /** @var ArticleSlug */
    private $slug;

    public function __construct(ArticleSlug $slug)
    {
        $this->slug = $slug;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'article_slug_not_found';
    }

    public function errorMessage(): string
    {
        return sprintf('The article slug <%s> not found', $this->slug->value());
    }

}