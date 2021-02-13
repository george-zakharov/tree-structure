<?php

/**
 * Class DbConnector.
 * Establish connection to DB with use of singleton pattern.
 */
class DbConnector
{
    /**
     * The instance of this class.
     * @var DbConnector|null
     */
    private static ?DbConnector $instance = null;

    /**
     * PDO Object.
     * @var PDO
     */
    private PDO $connection;

    /**
     * Name of the host of the DB.
     * @var string
     */
    private string $host = 'localhost';

    /**
     * Name of the DB.
     * @var string
     */
    private string $dbName = 'tree-structure';

    /**
     * Login for user of the DB.
     * @var string
     */
    private string $user = 'root';

    /**
     * Password for the user of the DB.
     * @var string
     */
    private string $pass = '';

    /**
     * Charset for DB connection.
     * @var string
     */
    private string $charset = 'UTF8';

    /**
     * DbConnector constructor.
     */
    private function __construct()
    {
        //$dsn is Data Source Name for PDO connection
        $dsn = "mysql:host=$this->host;dbname=$this->dbName;charset=$this->charset";
        //$opt is an options of the connection
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        //Set new PDO object
        $this->connection = new PDO($dsn, $this->user, $this->pass, $opt);
    }

    /**
     * Return an instance of the this class.
     *
     * @return DbConnector|null
     */
    public static function getInstance(): ?DbConnector
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }

    /**
     * Return PDO object to establish a connection.
     *
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}