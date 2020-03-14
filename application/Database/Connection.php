<?php


namespace Database;


use PDO;
use PDOException;

class Connection
{

    const devmode = true;

    private $DATA = CONFIG_GLOBAL['Database'];

    public $conn;

    public $error;

    public function __construct()
    {

        try
        {

            $dsn = "mysql:host={$this->DATA['host']};port={$this->DATA['port']};dbname={$this->DATA['dbname']}";

            $this->conn = new PDO($dsn, $this->DATA['username'], $this->DATA['password']);

            if (self::devmode)
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            else
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

        }
        catch (PDOException $e)
        {
            $this->error = $e->getMessage();
        }

    }

    private static function drivers_are_ok() : bool
    {

        if (extension_loaded('pdo'))
            return true;

        return false;

    }

}