<?php


namespace User\Model;

Use Database\Select;

class Get
{

    private const table = 'users';
    private $select;

    public function __construct()
    {
        $this->select = new Select();
    }

    public function byId(int $id) : array
    {
        $this->select->table = self::table;
        $this->select->data = 'login, name, email, password';
        $this->select->where = 'id = :id';
        $this->select->setAttribute(':id', $id);

        $stmt = $this->select->get();

        if (!$stmt)
            return [ 'success' => false, 'result' => $this->select->error];

        return ['success' => true, 'result' => $stmt];
    }

    public function byEmail(string $email) : array
    {
        $this->select->table = self::table;
        $this->select->data = 'login, name, email, password';
        $this->select->where = 'email = :email';
        $this->select->setAttribute(':email', $email);

        $stmt = $this->select->get();

        if (!$stmt)
            return [ 'success' => false, 'result' => $this->select->error];

        return ['success' => true, 'result' => $stmt];
    }



}