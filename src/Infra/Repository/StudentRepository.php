<?php

namespace Src\Infra\Repository;

use DateTimeInterface;
use PDOStatement;
use Src\Domain\Contracts\StudentContract;
use Src\Domain\Models\Phone;
use Src\Domain\Models\Student;
use Src\Infra\Persistence\Database;

/**
 * Manage student database
 * 
 * @package Src\Infra\Repository
 * @author  Thiago <thiagom.devsec@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
class StudentRepository extends Student implements StudentContract
{
    /** @var PDO */
    private \PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->open();
    }

    /**
     * Create new instance of Student with current data
     * 
     * @param PDOStatement
     * @return array
     */
    private function hydrateStudent(PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetchAll();
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new \DateTimeImmutable($studentData['birth_date'])
            );
        }

        return $studentList;
    }

    /**
     * Return all students
     * 
     * @return array
     */
    public function index(): array
    {
        $queryString = "SELECT * FROM {$this->table};";
        $stmt = $this->db->query($queryString);
        
        return $this->hydrateStudent($stmt);
    }

    /**
     * Insert new student
     * 
     * @param Student $student
     * @return bool
     */
    private function insert(Student $student): bool
    {
        $queryString = "INSERT INTO {$this->table}(name, birth_date) VALUES(:name, :birth_date);";
        $stmt = $this->db->prepare($queryString);

        $success = $stmt->execute([
            ':name' => $student->name(),
            ':birth_date' => $student->birthDate()->format('Y-m-d')
        ]);

        if ($success) {
            $student->setId($this->db->lastInsertId());
        }

        return $success;
    }

    /**
     * Update current student data
     * 
     * @param Student $student
     * @return bool
     */
    public function update(Student $student): bool
    {
        $queryString = "UPDATE {$this->table} SET name = :name, birth_date = :birth_date WHERE id = :id;";
        $stmt = $this->db->prepare($queryString);
        $stmt->bindValue(':name', $student->name());
        $stmt->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));
        $stmt->bindValue(':id', $student->id(), \PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Check is a new student or
     * update current register
     * 
     * @param Student
     * @return bool
     */
    public function save(Student $student): bool
    {
        if (is_null($student->id())) {
            return $this->insert($student);
        }

        return $this->update($student);
    }

    /**
     * Delete student
     * 
     * @param Student $student
     * @return bool
     */
    public function remove(Student $student): bool
    {
        $queryString = "DELETE FROM {$this->table} WHERE id = :id;";
        $stmt = $this->db->prepare($queryString);
        $stmt->bindParam(':id', $student->id(), \PDO::PARAM_INT);

        return $stmt->execute();
    }


    /**
     * All students thwat were born at custom birtdate
     * 
     * @param DateTimeInterface
     * @return array
     */
    public function studentsBirthAt(DateTimeInterface $birtDate): array
    {
        $queryString = "SELECT * FROM {$this->table} WHERE birth_date = :birth_date;";
        $stmt = $this->db->prepare($queryString);
        $stmt->bindParam(':birth_date', $birtDate->format('Y-m-d'));
        $stmt->execute();

        return $this->hydrateStudent($stmt);
    }

    /**
     * All students with cellphones
     * 
     * @return array
     */
    public function studentsWithPhones(): array
    {
        $queryString = "SELECT
            std.id, std.name, std.birth_date, ph.id AS phone_id, ph.area_code, ph.number
            FROM students AS std JOIN phones AS ph ON std.id = ph.id";

        $stmt = $this->db->prepare($queryString);
        $results = $stmt->fetchAll();
        $studentList = [];

        foreach ($results as $studentRow) {
            if (!array_key_exists($studentRow['id'], $studentList)) {
                $studentList[$studentRow['id']] = new Student(
                    $studentRow['id'],
                    $studentRow['name'],
                    new \DateTimeImmutable($studentRow['birth_date'])
                );
            }

            $phone = new Phone($studentRow['phone_id'], $studentRow['areaCode'], $studentRow['number']);
            $studentList[$studentRow['id']]->addPhone($phone);
        }


        return $studentList;
    }
}
