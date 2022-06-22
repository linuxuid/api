<?php 
namespace Models\ActiveRecord;

use Config\Database;

abstract class ActiveRecord 
{
    /** @var int */
    protected $id;
    
    /**
     * @return int
     */
    public function getId() : int 
    {
        return $this->id;
    }

    public function __set($name, $value)
    {
        $stringConversion = $this->stringConversion($name);
        $this->$stringConversion = $value;
    }

        /**
     * @return array[]
     */
    public static function findAll() : array 
    {
        $database = new Database();
        return $database->query('SELECT * FROM `' . static::getTableName() .  '`;', [], static::class);
    }

    abstract static function getTableName() : string;

    private function stringConversion(string $string)
    {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
    }
}