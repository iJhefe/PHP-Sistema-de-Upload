<?php


namespace Database;


class Insert extends Connection implements DbTemplate
{

    public $error;
    public $table;

    private $query;
    private $columns;
    private $values;
    private $attr;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute() : bool
    {

        $this->generateQuery();

        $stmt = $this->conn->prepare($this->query);

        return $stmt->execute($this->attr);

    }

    public function values(array $values)
    {

        $aux = '';

        foreach($values as $value)
        {
            $aux .= '? ,';

            $this->setAttribute('', $value);
        }



        // Tira a ultima virgula

        $this->values = substr($aux, 0, -1);

    }

    public function columns(array $columns) : void
    {

        $aux = '';

        foreach($columns as $column)
        {
            $aux .= $column . ',';
        }

        // Tira a ultima virgula

        $this->columns = substr($aux, 0,-1);

    }

    public function generateQuery()
    {

        if (empty($this->table))
            $this->error = 'Empty table';

        if (empty($this->values))
            $this->error = 'No values';


        $this->query = "INSERT INTO {$this->table} ";

        if (!empty($this->columns))
            $this->query .= "({$this->columns}) ";

        $this->query .= "VALUES ({$this->values})";


    }

    public function setAttribute(string $attr, string $value)
    {
        if (empty($attr))
            $this->attr[] = $value;
        else
            $this->attr[$attr] = $value;
    }
}