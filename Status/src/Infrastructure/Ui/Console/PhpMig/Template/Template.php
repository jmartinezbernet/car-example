<?php
    /** @var string $className */
    $sqlFile         = '../Sql/' . $className . '.sql';
    $sqlFileFullPath = __DIR__ . '/' . $sqlFile;

    if (file_exists($sqlFileFullPath)) {
        throw new InvalidArgumentException("File '$sqlFileFullPath' already exists");
    }

    file_put_contents($sqlFileFullPath, "# SQL commands for $className");
?>
<?= '<?php '; ?>

use Phpmig\Migration\Migration;
use Zend\Db\Adapter\Adapter;

class <?= $className; ?> extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = file_get_contents(__DIR__ . '/<?= $sqlFile; ?>');

        /** @var Psr\Container\ContainerInterface $container */
        $container = $this->getContainer()['container'];
        $container->get(Adapter::class)->query($sql, Adapter::QUERY_MODE_EXECUTE);
    }

    /**
     * Undo the migration
     */
    public function down()
    {

    }
}