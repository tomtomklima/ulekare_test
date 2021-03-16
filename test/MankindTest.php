<?php

namespace UlekareTest;

use PHPUnit\Framework\TestCase;
use Ulekare\Mankind;
use Ulekare\Patient;
use Ulekare\UlekareException;

class MankindTest extends TestCase
{
    /**
     * @param int    $expectedPatients
     * @param string $filename
     * @throws UlekareException
     * @dataProvider provideLoadPatientsFromCsvException
     */
    public function testLoadPatientsFromCsvException(
        int $expectedPatients,
        string $filename
    ): void {
        $this->expectException(UlekareException::class);

        $mankind = new Mankind();
        self::assertSame($expectedPatients, $mankind->loadPatientsFromCsv($filename));
    }

    /**
     * @return array<string, array>
     */
    public function provideLoadPatientsFromCsvException(): array
    {
        return [
            'example wrong file' => [
                6,
                __DIR__.'/patients.csv',
            ],
        ];
    }

    /**
     * @param int    $expectedPatients
     * @param string $filename
     * @param int[]  $patientIds
     * @throws UlekareException
     * @dataProvider provideLoadPatientsFromCsv
     */
    public function testLoadPatientsFromCsv(
        int $expectedPatients,
        string $filename,
        array $patientIds
    ): void {
        $mankind = new Mankind();
        self::assertSame($expectedPatients, $mankind->loadPatientsFromCsv($filename));

        $checkedPatients = 0;
        foreach ($mankind as $patientId => $patient) {
            self::assertContains($patientId, $patientIds);
            $checkedPatients++;
        }

        self::assertSame($expectedPatients, $checkedPatients);
    }

    /**
     * @return array<string, array>
     */
    public function provideLoadPatientsFromCsv(): array
    {
        return [
            'example file (corrected)' => [
                6,
                __DIR__.'/patients_corrected.csv',
                [123, 3457, 34, 57, 37, 137],
            ],
        ];
    }

    /**
     * @param string $filename
     * @param int    $patientId
     * @throws UlekareException
     * @dataProvider provideGetPatientById
     */
    public function testGetPatientById(string $filename, int $patientId): void
    {
        $mankind = new Mankind();
        $mankind->loadPatientsFromCsv($filename);

        self::assertInstanceOf(Patient::class, $mankind->getPatient($patientId));
    }

    /**
     * @return array<string, array>
     */
    public function provideGetPatientById(): array
    {
        return [
            'example' => [
                __DIR__.'/patients_corrected.csv',
                34,
            ],
        ];
    }

    // TODO test nonexistent patient

    /**
     * @param string $filename
     * @param float  $expectedPercents
     * @throws UlekareException
     * @dataProvider provideGetGenderPercent
     */
    public function testGetGenderPercent(string $filename, float $expectedPercents): void
    {
        $mankind = new Mankind();
        $mankind->loadPatientsFromCsv($filename);

        self::assertSame($expectedPercents, $mankind->getGenderPercent());
    }

    /**
     * @return array<string, array>
     */
    public function provideGetGenderPercent(): array
    {
        return [
            'example' => [
                __DIR__.'/patients_corrected.csv',
                0.5,
            ],
        ];
    }

    // TODO testGetGenderPercent to Exception with no patients

    /**
     * @param string             $filename
     * @param float              $expectedAge
     * @param \DateTimeImmutable $startDate
     * @throws UlekareException
     * @dataProvider provideGetAverageAge
     */
    public function testGetAverageAge(
        string $filename,
        float $expectedAge,
        \DateTimeImmutable $startDate
    ): void {
        $mankind = new Mankind();
        $mankind->loadPatientsFromCsv($filename);

        self::assertSame($expectedAge, $mankind->getAverageAge($startDate));
    }

    /**
     * @return array<string, array>
     */
    public function provideGetAverageAge(): array
    {
        return [
            'correct example' => [
                __DIR__.'/patients_corrected.csv',
                56.0,
                new \DateTimeImmutable('2021-03-16'),
            ],
        ];
    }

    // TODO testGetAverageAge to Exception with no correct patients
}
