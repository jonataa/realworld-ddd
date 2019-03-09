<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Domain\Exceptions;

use \Exception;
use RealWorld\Blog\Article\Domain\ArticleId;

class ArticleNotFoundException extends Exception
{

    public function __construct(ArticleId $id)
    {
        parent::__construct(sprintf('The article <%s> not found', $id->value()));
    }

}