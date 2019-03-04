<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Domain\Exceptions;

use \Exception;
use RealWorld\Blog\Article\Domain\ArticleSlug;

class ArticleNotFoundException extends Exception
{
    
    public function __construct(ArticleSlug $slug)
    {
        parent::__construct(sprintf(
            'article <%s> not found', $slug->slug()
        ));
    }
    
}