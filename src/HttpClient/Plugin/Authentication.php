<?php declare(strict_types=1);

namespace Enola\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

class Authentication implements Plugin
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        if ($request->hasHeader('Authorization')) {
            return $next($request);
        }

        return $next($request->withHeader('Authorization', \sprintf('Bearer %s', $this->token)));
    }
}
