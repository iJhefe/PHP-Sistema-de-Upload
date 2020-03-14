<?php


namespace Database;


use PDO;

class Select extends Connection implements DbTemplate
{

    private const defaultLimit = 20;
    private $attr;
    private $query;

    public $error;
    public $table;
    public $data;
    public $where;
    public $limit;

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {

        $this->generateQuery();

        if (!empty($this->error))
            return false;

        $stmt = $this->conn->prepare($this->query);

        foreach ($this->attr as $key => $value)
        {
            $stmt->bindParam($key, $value);
        }

        if ($stmt->execute())
            return $stmt->fetch(PDO::FETCH_ASSOC);

        $this->error = $stmt->errorInfo();

        return false;

    }

    public function setAttribute(string $attr, string $value)
    {
        $this->attr[$attr] = $value;
    }

    public function generateQuery()
    {
        if (empty($this->data))
            $this->data = '*';

        $query = 'SELECT ' . $this->data . ' FROM ';

        if (empty($this->table))
            $this->error = 'Empty table';

        $query .= $this->table . ' ';

        if (!empty($this->where))
            $query .= 'WHERE ' . $this->where . ' ';

        if (empty($this->limit))
        {
            if (!is_int($this->limit))
                $this->limit = self::defaultLimit;

            $this->limit = self::defaultLimit;
        }

        $query .= 'LIMIT ' . $this->limit;

         $this->query = $query;

    }
}