<?php 
namespace Config;

class Database 
{
    /**
     * @var \PDO 
     */
    private $pdo;

    /**
     * @var instance
     */
    private static $instance;

    private function __construct()
    {
        $databaseOptions = (require __DIR__ . '/Connection.php')['db'];

        $this->pdo = new \PDO(
            'mysql:host=' . $databaseOptions['host'] . ';dbname=' . $databaseOptions['dbname'], 
            $databaseOptions['user'],
            $databaseOptions['password'],
        );
        $this->pdo->exec('SET NAMES UTF8');
    }

    /**
     * @param \sql
     * @param \params = []
     */
    public function query(string $sql, array $params = [], string $className = 'stdClass'): array 
    {
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($params);

        if(false === $result) {
            return null;
        }

        return $stmt->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    /** Singleton pattern, only one object of class which available everywhere */
    public static function getInstance() : self  
    {
        if(self::$instance == null):
            self::$instance = new self();
        endif;
            return self::$instance;
    }

}


