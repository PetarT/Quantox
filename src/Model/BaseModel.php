<?php
/**
 * Created by PhpStorm.
 * User: petar
 * Date: 4.4.18.
 * Time: 11.27
 */

namespace Quantox\Domain\Model;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;

/**
 * Class BaseModel. Used for manipulating with entity data.
 *
 * @package Quantox\Domain\Model
 */
abstract class BaseModel
{
    /**
     * The connection name for the model.
     *
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The primary key for the model
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * BaseModel constructor.
     *
     * @throws DBALException
     */
    public function __construct()
    {
        $config           = new Configuration();
        $dbConfig         = \json_decode(\file_get_contents('../../config.json'), true);
        $this->connection = DriverManager::getConnection($dbConfig, $config);
    }

    /**
     * Creates row in table.
     *
     * @param    array $data
     * @throws   DBALException
     *
     * @return int
     */
    public function create(array $data): int
    {
        return $this->connection->insert($this->table, $data);
    }

    /**
     * Gets row from table.
     *
     * @param int $id
     * @throws DBALException
     *
     * @return array
     */
    public function get(int $id): array
    {
        $query = $this->connection->createQueryBuilder();
        $query->select('*')
            ->from($this->connection->quoteIdentifier($this->table))
            ->where($this->connection->quoteIdentifier($this->primaryKey) . ' = ?')
            ->setParameter(0, $id);

        return $this->connection->fetchAssoc($query);
    }

    /**
     * Updates row in table.
     *
     * @param array $data
     * @throws DBALException
     *
     * @return bool
     */
    public function update(array $data): bool
    {
        if (!empty($data[$this->primaryKey])) {
            $id = $data[$this->primaryKey];
            unset($data[$this->primaryKey]);
        }

        return (bool) $this->connection->update($this->table, $data, array($this->primaryKey => $id));
    }

    /**
     * Deletes row form the table.
     *
     * @param   int  $id
     * @throws DBALException
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        return (bool) $this->connection->delete($this->table, array($this->primaryKey => $id));
    }

    /**
     * Searches for rows with certain criteria.
     *
     * @param   array   $data
     * @param   bool    $exact
     *
     * @return  array
     */
    public function filter(array $data, $exact = false)
    {
        $query = 'SELECT * FROM ' . $this->connection->quoteIdentifier($this->table) . ' ';
        $where = array();

        foreach ($data as $key => $value) {
            $value = trim($value);

            if ($exact) {
                $where[] = $this->connection->quoteIdentifier($key) . ' = ' . $this->connection->quote($value);
            } else {
                $where[] = $this->connection->quoteIdentifier($key) .
                    ' LIKE ' . $this->connection->quote('%' . $value . '%');
            }
        }


        return $this->connection->fetchAll($query . implode(' AND ', $where));
    }

    /**
     * Returns DB connection.
     *
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
