<?php


namespace Database;


use Core\Path;
use Exception;
use PDOException;

class Schema extends Connection
{

    public $error;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute_sql_file(string $dir, string $filename) : bool
    {

        if (!strpos($filename, '.sql'))
            $filename .= '.sql';

        $file = Path::get_real_path($dir . $filename);

        if (!file_exists($file))
        {
            $this->error = 'Path not found';

            return false;
        }

        $sql = file_get_contents($file);

        return $this->exec($sql);
    }

    public function drop(string $tableName) : bool
    {

       $stmt = $this->conn->exec("DROP TABLE $tableName");

       return !$stmt ? false : true;

    }

    public function create_table(string $tableName, array $columns) : bool
    {

        $opts = '';

        try
        {
            foreach ( $columns as $name => $type ):
                if (empty($type) || !is_string($name) || !is_string($type))
                {
                    $this->error = 'Invalid column in "create table"';

                    return false;
                }

                $opts .= "$name $type";
            endforeach;
        }
        catch (Exception $e)
        {
            $this->error = $e->getMessage();

            return false;
        }

        if (empty($opts))
            return false;

        $query = "CREATE TABLE $tableName ( $opts )";

        return $this->exec($query);

    }

    public static function create_trigger(string $command)
    {
        // TODO
    }

    public static function get_all_tables()
    {
        // TODO
    }

    private function exec(string $sql) : bool
    {
        try
        {
            $stmt = $this->conn->exec($sql);
        }
        catch (PDOException $e)
        {
            $this->error = $e->getMessage();

            return false;
        }

        return !$stmt ? false : true;
    }

}