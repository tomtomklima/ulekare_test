<?php

namespace UlekareTest;

use Ulekare\Patient;

class PatientGetter
{
    public function getPatient(\DateTimeImmutable $dateOfBirth): Patient
    {
        return new Patient(
            0,
            'firstname',
            'lastname',
            Patient::GENDER_FEMALE,
            $dateOfBirth
        );
    }
}
