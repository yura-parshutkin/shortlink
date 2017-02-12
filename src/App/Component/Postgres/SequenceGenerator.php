<?php

namespace App\Component\Postgres;

class SequenceGenerator
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @param \PDO $db
     */
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @param $tableName
     * @return int
     */
    public function generate($tableName)
    {
        $sql   = "SELECT nextval('{$tableName}_id_seq')";
        $query = $this->db->prepare($sql);
        $query->execute();

        return (int)$query->fetchColumn();
    }
}