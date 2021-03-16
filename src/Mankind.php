<?php

namespace Ulekare;

/**
 * @implements \Iterator<Patient>
 */
class Mankind implements \Iterator
{
    /** @var Patient[] */
    private array $patients = [];
    private int $position = 0;

    public function loadPatientsFromCsv(string $filename): int
    {
        $importedPatients = 0;
        $fileHandler = fopen($filename, 'rb');
        if ($fileHandler === false) {
            throw new UlekareException('Cannot open file '.$filename);
        }

        $patientIds = [];
        while (($line = fgets($fileHandler)) !== false) {
            $patient = $this->mapPatient($line);
            $patientId = $patient->getId();

            if (in_array($patientId, $patientIds, true)) {
                throw new UlekareException('Loaded same ID twice: '.$patientId);
            }

            $this->patients[] = $patient;
            $patientIds[] = $patientId;
            $importedPatients++;
        }

        fclose($fileHandler);

        return $importedPatients;
    }

    private function mapPatient(string $csvLine): Patient
    {
        // example 123;Michal;Nový;M;01.11.1962
        [$id, $firstname, $surname, $gender, $date] = explode(';', $csvLine);

        try {
            $dateOfBirth = new \DateTimeImmutable($date);
        } catch (\Exception $e) {
            throw new UlekareException('Cannot convert date of birth into DateTime object: '.$date);
        }

        return new Patient((int)$id, $firstname, $surname, $gender, $dateOfBirth);
    }

    public function getPatient(int $patientId): ?Patient
    {
        // TODO optimalize if needed
        foreach ($this->patients as $patient) {
            if ($patient->getId() === $patientId) {
                return $patient;
            }
        }

        return null;
    }

    public function getGenderPercent(string $gender = Patient::GENDER_MALE): float
    {
        if ($gender !== Patient::GENDER_MALE && $gender !== Patient::GENDER_FEMALE) {
            throw new UlekareException('Got incorrect gender: '.$gender);
        }

        $patientsCount = count($this->patients);
        if ($patientsCount === 0) {
            throw new UlekareException('Cannot calculate gender percents, there are no patients in Mankind');
        }

        $genderedPatients = array_filter($this->patients, function (Patient $patient) use ($gender) {
            return $patient->getGender() === $gender;
        });

        return count($genderedPatients) / $patientsCount;
    }

    public function getAverageAge(
        ?\DateTimeImmutable $startDate = null,
        string $gender = Patient::GENDER_MALE
    ): float {
        if ($gender !== Patient::GENDER_MALE && $gender !== Patient::GENDER_FEMALE) {
            throw new UlekareException('Got incorrect gender: '.$gender);
        }

        $genderedPatients = array_filter($this->patients, function (Patient $patient) use ($gender) {
            return $patient->getGender() === $gender;
        });

        $genderedPatientsCount = count($genderedPatients);
        if ($genderedPatientsCount === 0) {
            throw new UlekareException('Cannot calculate average age, there are no patients with gender '.$gender);
        }

        $totalAge = 0;
        foreach ($genderedPatients as $patient) {
            $totalAge += $patient->getAgeInYears($startDate);
        }

        return $totalAge / $genderedPatientsCount;
    }

    public function current(): Patient
    {
        return $this->patients[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): int
    {
        return $this->patients[$this->position]->getId();
    }

    public function valid(): bool
    {
        return isset($this->patients[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}
