<?php


namespace Database;


interface DbTemplate
{

    public function generateQuery();

    public function setAttribute(string $attr, string $value);

}