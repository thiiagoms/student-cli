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
     * Default database path
     * 
     * @var string
    */
    private const DBPATH = __DIR__ . '/../../db.sqlite'; // change to mysql credentials

    /**
     * Create database connection
     * 
     * @return PDO
     */
    public static function open(): PDO
    {
        try {
            return new PDO('sqlite: ' . self::DBPATH);
        } catch (PDOException $e) {
            echo "Code: {$e->getCode()}\n Message: {$e->getMessage()}";
        }
    }
}
