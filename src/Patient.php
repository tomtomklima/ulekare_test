<?php

namespace Ulekare;

class Patient
{
    private int $id;
    private string $firstname;
    private string $surname;
    private string $gender;
    private \DateTimeImmutable $dateOfBirth;

    // refactor to Enum in PHP 8.1
    public const GENDER_MALE = 'M';
    public const GENDER_FEMALE = 'Z';

    public function __construct(
        int $id,
        string $firstname,
        string $surname,
        string $gender,
        \DateTimeImmutable $dateOfBirth
    ) {
        if (!in_array($gender, [self::GENDER_MALE, self::GENDER_FEMALE])) {
            throw new UlekareException('Gender has unexpexcted value '.$gender);
        }

        $this->id = $id;
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->gender = $gender;
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getDateOfBirth(): \DateTimeImmutable
    {
        return $this->dateOfBirth;
    }

    public function getAgeInDays(?\DateTimeImmutable $startDate = null): int
    {
        if ($startDate === null) {
            $startDate = (new \DateTimeImmutable('today'));
        }

        $days = $startDate->diff($this->getDateOfBirth())->days;
        if ($days === false) {
            throw new UlekareException('DateTimeImmutable->diff() fails');
        }

        return $days;
    }

    public function getAgeInYears(?\DateTimeImmutable $startDate = null): int
    {
        if ($startDate === null) {
            $startDate = (new \DateTimeImmutable('today'));
        }

        return $startDate->diff($this->getDateOfBirth())->y;
    }
}
