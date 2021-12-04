<?php

namespace Src\Domain\Models;

/**
 * Phones Model
 * 
 * @package Src\Domain\Models
 * @author  Thiago <thiagom.devsec@gmail.com>
 * @version 1.0
 */
class Phone
{
    /** @var int|null */
    private ?int $id;

    /** @var string */
    private string $areaCode;

    /** @var string */
    private string $number;

    public function __construct(?int $id, string $areaCode, string $number)
    {
        $this->id = $id;
        $this->areaCode = $areaCode;
        $this->number = $number;
    }

    /**
     * Return phone formatted with number and area code
     * 
     * @return string
     */
    public function formatCellphone(): string
    {
        return "($this->areaCode) $this->number";
    }
}
