<?php


namespace Database;


class Update extends Connection implements DbTemplate
{

    public $table;
    public $data;
    public $noWhere;
    public $where;
    public $error;
    private $attr;

    public function __construct()
    {
        parent::__construct();
        $this->noWhere = false;
    }

    public function execute() : bool
    {

        $stmt = $this->conn->prepare( $this->generateQuery() );

        if (!empty($this->error))
            return false;

        foreach ($this->attr as $key => $value)
        {
            if (!is_string($key)) { $this->error = 'Invalid attr'; return false; }

            $stmt->bindParam($key, $value);
        }

        return $stmt->execute();

    }

    public function generateQuery()
    {
        $query = "UPDATE {$this->table} SET {$this->data}";

        if (empty($this->where))
            if (!$this->noWhere)
                $this->error = 'Empty where clause with false no-where';

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