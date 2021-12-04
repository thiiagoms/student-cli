<?php

namespace Src\Domain\Models;

use DateTimeInterface;

/**
 * Student entity
 * 
 * @package Src\Models
 * @author  Thiago <thiagom.devsec@gmail.com>
 * @version 1.0
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
class Student
{
    /** 
     * Student table name
     * 
     * @var string
     */
    protected string $table = 'students';

    /** 
     * Student id
     * 
     * @var int|null
     */
    private ?int $id;

    /**
     * Student name
     * 
     * @var string 
     */
    private string $name;

    /** 
     * Student BirthDate
     * 
     * @var DateTimeInterface
     */
    private DateTimeInterface $birthDate;

    /** @var Phones[] */
    private array $phones = [];

    /**
     * Build student object
     * 
     * @param int|null $id
     * @param string $name
     * @param DateTimeInterface $birthDate
     */
    public function __construct(?int $id, string $name, DateTimeInterface $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    /**
     * Student id
     * 
     * @return int|null
     */
    public function id(): ?int
    {
        return $this->id;
    }

    /**
     * Student name
     * 
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Student birthDate
     * 
     * @return DateTimeInterface
     */
    public function birthDate(): DateTimeInterface
    {
        return $this->birthDate;
    }

    /**
     * Current student age
     * 
     * @return int
     */
    public function age(): int
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable())
            ->y;
    }

    /**
     * Change current student name
     * 
     * @param string
     * @return void
     */
    public function changeName(string $newName): void
    {
        $this->name = $newName;
    }

    /**
     * Check if student already have id
     * 
     * @param int
     * @return void
     */
    public function setId(int $id): void
    {
        if (!is_null($this->id)) {
            throw new \DomainException("[*] You must define this ID one time");
        }

        $this->id = $id;
    }

    /**
     * Add student cellphone
     * 
     * @param Phone
     * @return void
     */
    public function addPhone(Phone $phone): void
    {
        $this->phones[] = $phone;
    }
    
    /**
     * Return all student cellphones
     * 
     * @return Phones[]
     */
    public function phones(): array
    {
        return $this->phones;
    }
}
