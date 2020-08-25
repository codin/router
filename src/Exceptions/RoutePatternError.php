<?php

declare(strict_types=1);

namespace Codin\Router\Exceptions;

class RoutePatternError extends \InvalidArgumentException
{
    public static function create(int $error): self
    {
        switch ($error) {
            case PREG_INTERNAL_ERROR:
                $message = 'Internal error';
                break;
            case PREG_BACKTRACK_LIMIT_ERROR:
                $message = 'Backtrack limit was exhausted';
                break;
            case PREG_RECURSION_LIMIT_ERROR:
                $message = 'Recursion limit was exhausted';
                break;
            case PREG_BAD_UTF8_ERROR:
                $message = 'Bad UTF8 error';
                break;
            case PREG_BAD_UTF8_OFFSET_ERROR:
                $message = 'Bad UTF8 offset error';
                break;
            default:
                $message = 'Unknown Error';
        }

        return new self(sprintf('Error Code %u. %s', $error, $message));
    }
}
