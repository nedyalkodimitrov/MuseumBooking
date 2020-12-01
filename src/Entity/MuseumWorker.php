<?php

namespace App\Entity;

use App\Repository\MuseumWorkerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MuseumWorkerRepository::class)
 */
class MuseumWorker
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="Museum", inversedBy="worker")
     */
    public  $museum;

    /**
     * @ORM\Column(type="string")
     */
    public $name;

    /**
     * @ORM\Column(type="string")
     */
    public $fName;

    /**
     * @ORM\Column(type="string")
     */
    public $phoneNumber;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="tourOperators")
     */
    public  $city;





    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMuseum()
    {
        return $this->museum;
    }

    /**
     * @param mixed $museum
     */
    public function setMuseum($museum): void
    {
        $this->museum = $museum;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFName()
    {
        return $this->fName;
    }

    /**
     * @param mixed $fName
     */
    public function setFName($fName): void
    {
        $this->fName = $fName;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
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



}
