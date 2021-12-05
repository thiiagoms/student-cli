<?php

namespace Src\Infra\Persistence;

/**
 * Load env Values
 * 
 * @package Src\Infra\Persistence
 * @author  Thiago <thiagom.devsec@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.0
 */
class Env
{

    /**
     * Env file default dir
     * 
     * @var string
     */
    private const ENVPATH = __DIR__ . '/../../../.env';

    /**
     * Check if env file exists and if is readable
     * 
     */
    public function __construct()
    {
        if (!file_exists(self::ENVPATH)) {
            throw new \InvalidArgumentException(sprintf("=> File not exists: %s", self::ENVPATH));
        }

        if (!is_readable(self::ENVPATH)) {
            throw new \RuntimeException(sprintf("=> File %s is not readable.", self::ENVPATH));
        }
    }

    /**
     * Load env values
     * 
     * @return void
     */
    public function load(): void
    {
        $rows = file(self::ENVPATH, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($rows as $row) {

            if (strpos(trim($row), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $row, 2);

            $name = trim($name);
            $value = trim($value);

            if (
                !array_key_exists($name, $_SERVER) &&
                !array_key_exists($name, $_ENV)
            ) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVE[$name] = $value;
            }
        }
    }
}