<?php 
namespace Config;

class Database 
{
    /**
     * @var \PDO 
     */
    private $pdo;

    public function __construct()
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
}


