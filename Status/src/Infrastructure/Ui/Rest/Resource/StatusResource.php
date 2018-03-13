<?php

namespace Status\Infrastructure\Ui\Rest\Resource;

use Lukasoppermann\Httpstatus\Httpstatuscodes;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Status\Infrastructure\Ui\Rest\Middleware\AbstractRestFulMiddleware;
use Zend\Diactoros\Response\JsonResponse;

class StatusResource extends AbstractRestFulMiddleware
{
    public function get(ServerRequestInterface $request): ResponseInterface
    {
        return (new JsonResponse('OK'))
            ->withStatus(Httpstatuscodes::HTTP_OK);
    }
}