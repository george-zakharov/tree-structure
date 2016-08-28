<?php
/**
 * Class DbConnector.
 * Establish connection to DB with use of singleton pattern.
 */
class DbConnector {

    /**
     * @var null
     */
    private static $instance = null;

    /**
     * @var PDO
     */
    private $connection;

    /**
     * @var string
     */
    private $host = 'localhost';

    /**
     * @var string
     */
    private $dbname = 'tree-structure';

    /**
     * @var string
     */
    private $user = 'root';

    /**
     * @var string
     */
    private $pass = '';

    /**
     * @var string
     */
    private $charset = 'UTF8';

    /**
     * DbConnector constructor.
     */
    private function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->connection = new PDO($dsn, $this->user, $this->pass, $opt);
    }

    /**
     * @return DbConnector|null
     */
    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}