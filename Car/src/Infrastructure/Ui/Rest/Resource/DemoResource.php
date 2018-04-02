<?php
/**
 * Created by PhpStorm.
 * User: jmartinez
 * Date: 14/03/18
 * Time: 16:44
 */

namespace Status\Infrastructure\Ui\Rest\Resource;


use Lukasoppermann\Httpstatus\Httpstatuscodes;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Status\Application\Service\GetDemoStatusRequest;
use Status\Application\Service\GetDemoStatusService;
use Status\Infrastructure\Ui\Rest\Middleware\AbstractRestFulMiddleware;
use Zend\Diactoros\Response\JsonResponse;

class DemoResource extends AbstractRestFulMiddleware
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function get(ServerRequestInterface $request): ResponseInterface
    {
        $demoId = $request->getAttribute('demoId');

        try {
            $demo = $this->applicationService(GetDemoStatusService::class)->execute(
                new GetDemoStatusRequest(
                    $demoId
                )
            );
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage(), Httpstatuscodes::HTTP_BAD_REQUEST);
        }

        return (new JsonResponse($demo, Httpstatuscodes::HTTP_OK))
            ->withHeader('location', $demoId)
            ->withStatus(201, 'OK');
    }
}