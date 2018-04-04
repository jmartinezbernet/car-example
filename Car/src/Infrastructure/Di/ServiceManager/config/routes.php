<?php

return function (\Zend\Expressive\Application $app): void {

    $app->get('/car?{query}', \Car\Infrastructure\Ui\Rest\Resource\CarCollectionResource::class);
};
