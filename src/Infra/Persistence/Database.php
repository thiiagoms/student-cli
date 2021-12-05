<?php

namespace Src\Infra\Persistence;

use PDOException, PDO;

/**
 * Manage database connection
 * 
 * @package Src\Infra\Persistence
 * @author  Thiago <thiagom.devsec@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
class Database
{
    /**
     * Database host
     * 
     * @var string
     */
    private string $dbHost;

    /**
     * Database port
     * 
     * @var string
     */
    private string $dbPort;

    /**
     * Database name
     * 
     * @var string
     */
    private string $dbName;

    /**
     * Database user
     * 
     * @var string
     */
    private string $dbUser;

    /**
     * User password
     * 
     * @var string
     */
    private string $dbPass;

    /** 
     * Database connection
     * 
     * @var PDO
     */
    private PDO $con;

    public function __construct()
    {
        (new Env())->load();

        $this->dbHost = $_ENV['DATABASE_HOST'];
        $this->dbPort = $_ENV['DATABASE_PORT'];
        $this->dbName = $_ENV['DATABASE_NAME'];
        $this->dbUser = $_ENV['DATABASE_USER'];
        $this->dbPass = $_ENV['DATABASE_PASS'];
    }

    /**
     * Create database connection
     * 
     * @return PDO
     */
    public function open(): PDO
    {
        try {
            $this->con = new PDO('mysql:host=' . $this->dbHost . ';port=' . $this->dbPort . ';dbname=' . $this->dbName, $this->dbUser, $this->dbPass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $this->con;
        } catch (PDOException $e) {
            echo "Code: {$e->getCode()}\n Message: {$e->getMessage()}";
        }
    }
}
