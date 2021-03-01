<?php

namespace App\Entity;

use App\Repository\MuseumReviewsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MuseumReviewsRepository::class)
 */
class MuseumReview
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="string")
     */
    public $text;

   /**
     * @ORM\Column(type="string")
     */
    public $date;

    /**
     * @ORM\ManyToOne(targetEntity="TourOperator", inversedBy="reviews")
     */
    public  $tourOperator;

    /**
     * @ORM\ManyToOne(targetEntity="Museum", inversedBy="review")
     */
    public  $museum;

    /**
     * @ORM\Column(type="float")
     */
    public $rating;




    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
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
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }




}
