<?php

namespace Src\Domain\Contracts;

use Src\Domain\Models\Student;

/**
 * StudentRepository should have
 * 
 * @package Src\Domain\Contracts
 * @author  Thiago <thiagom.devsec@gmal.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.0
 */
interface StudentContract
{
    public function index(): array;
    public function studentsWithPhones(): array;
    public function studentsBirthAt(\DateTimeInterface $birtDate): array;
    public function save(Student $student): bool;
    public function remove(Student $student): bool;
}
