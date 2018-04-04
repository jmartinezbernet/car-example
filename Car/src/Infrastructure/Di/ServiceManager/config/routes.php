<?php

return function (\Zend\Expressive\Application $app): void {

    $app->post('/car', \Status\Infrastructure\Ui\Rest\Resource\CarCollectionResource::class);
};
