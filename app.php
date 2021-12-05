#!/usr/bin/env php
<?php

use Src\Domain\Models\Student;
use Src\Infra\Printer\Printer;
use Src\Infra\Repository\StudentRepository;

require_once __DIR__ . '/vendor/autoload.php';

$printer = new Printer();
$studentRepo = new StudentRepository();

$helper = ['--help', '-h'];
$createHelper = ['--create'];
$listHelper = ['--list'];

$printer->display("

██████╗ ██╗      █████╗ ███████╗███████╗
██╔════╝██║     ██╔══██╗██╔════╝██╔════╝
██║     ██║     ███████║███████╗███████╗
██║     ██║     ██╔══██║╚════██║╚════██║
╚██████╗███████╗██║  ██║███████║███████║
╚═════╝╚══════╝╚═╝  ╚═╝╚══════╝╚══════╝

[*] Author: Thiago thiiagoms
[*] Description: Little CLI crud
[*] Version: 1.0

=> For get help use: --help | -h

$ php app.php --help ");

if (isset($argv[1])) {

    if (in_array($argv[1], $helper) !== null) {
        return $printer->display("
            Args:
            --create => create new student
            --list => list all students
            --remove => remove all students
        ");
    }

    if (in_array($argv[1], $createHelper)) {
        $printer->display('');
        $studentName = readline("[*] Student name: ");
        $studentBirthDate = readline("[*] Student birthdate (Y-m-d): ");

        $student = new Student(
            null,
            $studentName,
            new \DateTimeImmutable(date('Y-m-d', strtotime($studentBirthDate)))
        );

        if ($studentRepo->save($student)) {
            $printer->display("=> Student {$studentName} registration was a success!");
            return;
        }

        return $printer->display("=> Something wrong hgappened");
    }

    if (in_array($argv[1], $listHelper)) {

        $printer->display("==== List all students ====");
        $students = $studentRepo->index();

        foreach ($students as $std) {
            $printer->display("
                [*] Student name: {$std->name()}
                [*] Student birthdate: {$std->birthDate()->format('Y-m-d')}
                [*] Age: {$std->age()}
            ");
        }
        return;
    }
}
