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
     * @param int /$id
     * @return static|null
     */
    public static function find(int $id) : ?self
    {
        $database = Database::getInstance();
        $recordId = $database->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id = :id;',
            [':id' => $id],
            static::class
        );
        return $recordId ? $recordId[0] : null; // return or array index[0] else null
    }

    /**
     * @return array[]
     */
    public static function findAll() : array 
    {
        $database = Database::getInstance();
        return $database->query('SELECT * FROM `' . static::getTableName() .  '`;', [], static::class);
    }

    public function save() : void 
    {
        $mapProperties = $this->conversionToDbFormat();
        if($this->id !== null){
            $this->update($mapProperties);
        } else {
            $this->insert($mapProperties);
        }
    }

    /**
     * @return void
     */
    private function update(array $mappedProperties) : void 
    {
        $columnToParams = [];
        $paramsToValues = [];
        $index = 1;
        foreach($mappedProperties as $column => $value)
        {
            $param = ':param' . $index;
            $columnToParams[] = $column . ' = ' . $param;
            $paramsToValues[$param] = $value;
            $index++;
        }

        $query = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columnToParams) . ' WHERE id = ' . $this->id;
        
        $database = Database::getInstance();
        $database->query($query, $paramsToValues, static::class);
    }

    /**
     * @return void
     */
    private function insert(array $mappedProperties) : void 
    {
        $columnToParams = [];
        $paramsToValues = [];
        $index = 1;
        foreach($mappedProperties as $column => $value){
            $param = ':param' . $index;
            $columnToParams[] = $column . ' = ' . $param;
            $paramsToValues[$param] = $value;
            $index++;
        }
        $query = 'INSERT INTO ' . static::getTableName() . ' SET ' . implode(', ', $columnToParams);
        $database = Database::getInstance();
        $database->query($query, $paramsToValues, static::class);
    }

    public function delete() : void 
    {
        $database = Database::getInstance();
        $database->query(
            'DELETE FROM `' . static::getTableName() . '` WHERE id = :id',
            [':id' => $this->id]
        );
        $this->id = null;
    }

    /**
     * @param string
     * @param value
     * 
     */
    public static function findUniqueValues(string $columnName, $value)
    {
        $database = Database::getInstance(); // use SingleTone
        $result = $database->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value;', 
            [':value' => $value],
            static::class,
        );

        if ($result === []){
            return null;
        }
        return $result[0];
    }

    /**
     * @return array[]
     */
    private function conversionToDbFormat() : array 
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
    
        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderCase = $this->stringConversionToUnderCase($propertyName);
            $mappedProperties[$propertyNameAsUnderCase] = $this->$propertyName;
        }
    
        return $mappedProperties;
    }

    /**
     * @return string
     */
    abstract static function getTableName() : string;

    /**
     * @return string
     */
    private function stringConversionToUnderCase(string $string) : string
    {
        return strtolower(preg_replace('~(?<!^)[A-Z]~', '_$0', $string));
    }

    /**
     * @return string
     */
    protected function stringConversion(string $string) : string
    {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
    }
}