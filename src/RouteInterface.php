<?php

declare(strict_types=1);

namespace Codin\Router;

interface RouteInterface
{
    public const METHOD_ANY = 'ANY';

    public const METHOD_CONNECT = 'CONNECT';

    public const METHOD_TRACE = 'TRACE';

    public const METHOD_GET = 'GET';

    public const METHOD_HEAD = 'HEAD';

    public const METHOD_OPTIONS = 'OPTIONS';

    public const METHOD_POST = 'POST';

    public const METHOD_PUT = 'PUT';

    public const METHOD_PATCH = 'PATCH';

    public const METHOD_DELETE = 'DELETE';

    public function getMethod(): string;

    public function getPath(): string;

    /**
     * @return mixed
     */
    public function getController();

    public function getParams(): array;

    public function withParams(array $params): self;
}
