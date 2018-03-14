<?php

namespace Status\Application\Service;

class GetDemoStatusRequest
{
    /**
     * @var string
     */
    private $id;

    /**
     * GetDemoStatusRequest constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }
}