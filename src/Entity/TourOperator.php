<?php

namespace App\Entity;

use App\Repository\TourOperatorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TourOperatorRepository::class)
 */
class TourOperator
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="tourOperator")
     */
    public  $user;

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

    /**
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="tourOperator")
     */
    public  $tickets;

    /**
     * @ORM\Column(type="float")
     */
    public $visitRating;




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
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * @param mixed $tickets
     */
    public function setTickets($tickets): void
    {
        $this->tickets = $tickets;
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
    public function getVisitRating()
    {
        return $this->visitRating;
    }

    /**
     * @param mixed $visitRating
     */
    public function setVisitRating($visitRating): void
    {
        $this->visitRating = $visitRating;
    }




}
