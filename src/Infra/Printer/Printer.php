<?php

namespace Src\Infra\Printer;

/**
 * Printer package
 * 
 * @author  Thiago <thiagom.devsec@gmail.com>
 * @package Src\Infra\Printer
 * @version 1.0
 */
class Printer
{
    /**
     * Print message
     * 
     * @param string
     * @return void
     */
    private function out(string $message): void
    {
        echo $message;
    }

    /**
     * Add new line
     * 
     * @return void
     */
    private function newLine(): void
    {
        $this->out(PHP_EOL);
    }

    /**
     * Mount display
     * 
     * @param string
     * @return void
     */
    public function display(string $message): void
    {
        $this->newLine();
        $this->out($message);
        $this->newLine();
    }
}
