<?php declare(strict_types=1);

namespace Enola\HttpClient\Plugin;

use Enola\Exception\ErrorException;
use Enola\Exception\RuntimeException;
use Enola\HttpClient\Message\ResponseMediator;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class OpenApiExceptionThrower implements Plugin
{
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response) use ($request) {
            if ($response->getStatusCode() < 400 || $response->getStatusCode() > 600) {
                return $response;
            }

            $content = ResponseMediator::getContent($response);
            if (\is_array($content) && isset($content['message'])) {
                throw new ErrorException((string) $content['message']);
            }

            throw new RuntimeException($content['message'] ?? 'Unexpected exception', $response->getStatusCode());
        });
    }
}
