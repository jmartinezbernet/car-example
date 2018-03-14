<?php

namespace Status\Application\Query;

interface FindDemoByIdQuery
{
    public function find(string $id): ?array;
}