<?php


namespace Database;


class Delete extends Connection implements DbTemplate
{

    public $table;
    public $where;
    public $noWhere;
    public $error;
    private $attr;

    public function __construct()
    {
        parent::__construct();

        $this->noWhere = false;
    }

    public function execute() : bool
    {

        $query = $this->generateQuery();

        if (!empty($this->error))
            return false;

        $stmt = $this->conn->prepare($query);

        foreach ($this->attr as $key => $value)
        {
            if (!is_string($key)) { $this->error = 'Invalid attr'; return false; }

            $stmt->bindParam($key, $value);
        }

            return $stmt->execute();
    }

    public function generateQuery() : string
    {
        $query = 'DELETE FROM ';

        if (empty($this->table))
            $this->error = 'No table given';

        if (empty($this->where))
            if (!$this->noWhere)
                $this->error = 'DELETE without WHERE Clause and noWhere == false ';

        $query .= "{$this->table} " . (empty($this->where) ? '' : "WHERE {$this->where}");

        return $query;

    }

    public function setAttribute(string $attr, string $value)
    {
        if (empty($attr))
            $this->attr[] = $value;
        else
            $this->attr[$attr] = $value;
    }
}