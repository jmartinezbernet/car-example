<?php

namespace Car\Infrastructure\Persistence\MySql;

use Car\Domain\CarRepository;
use Car\Domain\CarState;
use Car\Infrastructure\Hydrator\CarStateHydrator;
use Ramsey\Uuid\Uuid;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;

class MySqlCarRepository implements CarRepository
{
    private CONST TABLE_NAME = 'car';
    
    /**
     * @var CarStateHydrator
     */
    private $hydrator;
    /**
     * @var Adapter
     */
    private $adapter;

    /**
     * MySqlCarRepository constructor.
     * @param CarStateHydrator $hydrator
     * @param Adapter $adapter
     */
    public function __construct(
        CarStateHydrator $hydrator,
        Adapter $adapter
    )
    {
        $this->hydrator = $hydrator;
        $this->adapter = $adapter;
    }

    public function ofId(string $id): ?CarState
    {
        // TODO: Implement ofId() method.
    }

    public function save(CarState $carState): void
    {
        $values = [
            'id'   => $carState->id(),
            'data' => json_encode($this->hydrator->extract($carState))
        ];

        $table = new TableGateway(self::TABLE_NAME, $this->adapter);
        if (!$table->select(['id' => $values['id']])->current()) {
            $table->insert($values);
        } else {
            $table->update($values, ['id' => $values['id']]);
        }
    }

    public function nextId(): string
    {
        return Uuid::uuid4()->toString();
    }
}