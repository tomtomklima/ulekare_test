<?php

namespace UlekareTest;

use PHPUnit\Framework\TestCase;
use Ulekare\Patient;
use Ulekare\UlekareException;

class PatientTest extends TestCase
{
    /**
     * @param Patient                 $patient
     * @param int                     $expextedDays
     * @param \DateTimeImmutable|null $startDate
     * @dataProvider provideGetPatientAgeInDays
     * @throws UlekareException
     */
    public function testGetPatientAgeInDays(
        Patient $patient,
        int $expextedDays,
        ?\DateTimeImmutable $startDate
    ): void {
        self::assertSame($expextedDays, $patient->getAgeInDays($startDate));
    }

    /**
     * @return array<string, array>
     */
    public function provideGetPatientAgeInDays(): array
    {
        $patientGetter = new PatientGetter();

        return [
            'default today' => [
                $patientGetter->getPatient(new \DateTimeImmutable()),
                0,
                null,
            ],
            'explicit today' => [
                $patientGetter->getPatient(new \DateTimeImmutable()),
                0,
                new \DateTimeImmutable(),
            ],
            'one year' => [
                $patientGetter->getPatient(new \DateTimeImmutable('2018-04-02')),
                365,
                new \DateTimeImmutable('2019-04-02'),
            ],
            'one leap year' => [
                $patientGetter->getPatient(new \DateTimeImmutable('2020-01-01')),
                366,
                new \DateTimeImmutable('2021-01-01'),
            ],
        ];
    }
}
