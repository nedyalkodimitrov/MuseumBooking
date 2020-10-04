<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     */
    public $country;

    /**
     * @ORM\ManyToOne(targetEntity="Admin", inversedBy="city")
     */
    public $museums;
    /**
     * @ORM\ManyToOne(targetEntity="TourOperator", inversedBy="city")
     */
    public $tourOperators;

    /**
     * @ORM\Column(type="string")
     */
    public $name;
    /**
     * @ORM\Column(type="blob")
     */
    public $image;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
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
    public function getMuseums()
    {
        return $this->museums;
    }

    /**
     * @param mixed $museums
     */
    public function setMuseums($museums): void
    {
        $this->museums = $museums;
    }

    /**
     * @return mixed
     */
    public function getTourOperators()
    {
        return $this->tourOperators;
    }

    /**
     * @param mixed $tourOperators
     */
    public function setTourOperators($tourOperators): void
    {
        $this->tourOperators = $tourOperators;
    }




}
