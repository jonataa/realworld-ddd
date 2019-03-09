<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Domain;

use RealWorld\Shared\Domain\Bus\Event\DomainEvent;


final class ArticleCreatedDomainEvent extends DomainEvent
{

    public static function eventName(): string
    {
        return 'article_created';
    }

}