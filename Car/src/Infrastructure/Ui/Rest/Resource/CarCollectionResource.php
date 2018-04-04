<?php

namespace Car\Infrastructure\Ui\Rest\Resource;

use Car\Application\Query\FindCarsByCriteriaQuery;
use Car\Application\Service\GetCarsRequest;
use Car\Application\Service\GetCarsService;
use Car\Infrastructure\Ui\Rest\Middleware\AbstractRestFulMiddleware;
use Lukasoppermann\Httpstatus\Httpstatuscodes;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class CarCollectionResource extends AbstractRestFulMiddleware
{
    /**
     * @param $query
     * @return array
     */
    private static function parseQueryParameters($query): array
    {
        $filter = [];
        $ordination = [];
        $page = 1;
        $pageSize = FindCarsByCriteriaQuery::PAGE_SIZE;

        foreach (explode("&", $query) as $parameter) {
            if (explode("=", $parameter)[0] === 'page') {
                $page = explode("=", $parameter)[1];
            } else if (explode("=", $parameter)[0] === 'pageSize') {
                $pageSize = explode("=", $parameter)[1];
            } else if (strpos(explode("=", $parameter)[1], "ASC") !== false ||
                strpos(explode("=", $parameter)[1], "DESC") !== false) {
                array_push(
                    $ordination,
                    [
                        'field' => explode("=", $parameter)[0],
                        'value' => explode("=", $parameter)[1]
                    ]
                );
            } else {
                array_push(
                    $filter,
                    [
                        'field' => explode("=", $parameter)[0],
                        'value' => explode("=", $parameter)[1]
                    ]
                );
            }
        }
        return array($filter, $ordination, $page, $pageSize);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function get(ServerRequestInterface $request): ResponseInterface
    {
        $query = $request->getUri()->getQuery();

        list($filter, $ordination, $page, $pageSize) = self::parseQueryParameters($query);

        try {
            $carList = $this->applicationService(GetCarsService::class)->execute(
                new GetCarsRequest(
                    $filter,
                    $ordination,
                    $page,
                    $pageSize)
            );
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage(), Httpstatuscodes::HTTP_BAD_REQUEST);
        }

        return (new JsonResponse($carList, Httpstatuscodes::HTTP_OK))
            ->withStatus(200, 'OK');
    }
}