<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="admin")
     */
    public  $user;

    /**
     * @ORM\Column(type="string")
     */
    public $museumName;

    /**
     * @ORM\Column(type="string")
     */
    public $additionalInformation;

    /**
     * @ORM\OneToMany(targetEntity="City", mappedBy="museums")
     */
    public  $city;

    /**
     * @ORM\Column(type="blob")
     */
    public $image;

    /**
     * @ORM\Column(type="integer")
     */
    public $maxCapacity;

    /**
     * @ORM\OneToMany(targetEntity="Schedule", mappedBy="museum")
     */
    public  $schedule;



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getMuseumName()
    {
        return $this->museumName;
    }

    /**
     * @param mixed $museumName
     */
    public function setMuseumName($museumName): void
    {
        $this->museumName = $museumName;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getMaxCapacity()
    {
        return $this->maxCapacity;
    }

    /**
     * @param mixed $maxCapacity
     */
    public function setMaxCapacity($maxCapacity): void
    {
        $this->maxCapacity = $maxCapacity;
    }

    /**
     * @return mixed
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * @param mixed $schedule
     */
    public function setSchedule($schedule): void
    {
        $this->schedule = $schedule;
    }

    /**
     * @return mixed
     */
    public function getAdditionalInformation()
    {
        return $this->additionalInformation;
    }

    /**
     * @param mixed $additionalInformation
     */
    public function setAdditionalInformation($additionalInformation): void
    {
        $this->additionalInformation = $additionalInformation;
    }






}
