<?php

declare(strict_types = 1);

namespace RealWorld\Article\Domain\Exceptions;

use \Exception;
use RealWorld\Article\Domain\ArticleSlug;

class ArticleNotFoundException extends Exception
{
    
    public function __construct(ArticleSlug $slug)
    {
        parent::__construct($slug->slug());
    }
    
}