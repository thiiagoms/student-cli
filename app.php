#!/usr/bin/env php
<?php

use Src\Domain\Models\Student;
use Src\Infra\Repository\StudentRepository;
use Src\Infra\Persistence\Database;

require_once __DIR__ . '/vendor/autoload.php';

$db = Database::open();

var_dump($db);
exit;

$student = new Student(
    null,
    'Thiago Martins',
    new \DateTimeImmutable('1996-12-04')
);

$repo = new StudentRepository();
$repo->save($student);
