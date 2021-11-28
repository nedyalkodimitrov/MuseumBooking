<?php

namespace App\Entity;

use App\Repository\WishListRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WishListRepository::class)
 */
class WishList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="TourOperator", inversedBy="wishList")
     */
    public  $tourOperator;

    /**
     * @ORM\ManyToOne(targetEntity="Museum", inversedBy="wishList")
     */
    public  $museum;

    /**
     * @ORM\ManyToOne(targetEntity="Landmark", inversedBy="wishList")
     */
    public  $landmark;


    /**
    * @ORM\Column(type="string")
    */
    private $addedDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTourOperator()
    {
        return $this->tourOperator;
    }

    /**
     * @param mixed $tourOperator
     */
    public function setTourOperator($tourOperator): void
    {
        $this->tourOperator = $tourOperator;
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
    public function getAddedDate()
    {
        return $this->addedDate;
    }

    /**
     * @param mixed $addedDate
     */
    public function setAddedDate($addedDate): void
    {
        $this->addedDate = $addedDate;
    }

    /**
     * @return mixed
     */
    public function getLandmark()
    {
        return $this->landmark;
    }

    /**
     * @param mixed $landmark
     */
    public function setLandmark($landmark): void
    {
        $this->landmark = $landmark;
    }




}
