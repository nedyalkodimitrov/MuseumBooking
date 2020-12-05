<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    public $time;
    /**
     * @ORM\Column(type="date")
     */
    public $boughtDate;

    /**
     * @ORM\Column(type="date")
     */
    public $reservedDate;


    /**
     * @ORM\Column(type="integer")
     */
    public $number;


    /**
     * @ORM\ManyToOne (targetEntity="TourOperator", inversedBy="tickets")
     */
    public  $tourOperator;

    /**
     * @ORM\ManyToOne  (targetEntity="Schedule", inversedBy="tickets")
     */
    public  $schedule;


    /**
     * @ORM\Column(type="boolean")
     */
    public $hasCome = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time): void
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
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
    public function getHasCome()
    {
        return $this->hasCome;
    }

    /**
     * @param mixed $hasCome
     */
    public function setHasCome($hasCome): void
    {
        $this->hasCome = $hasCome;
    }

    /**
     * @return mixed
     */
    public function getBoughtDate()
    {
        return $this->boughtDate;
    }

    /**
     * @param mixed $boughtDate
     */
    public function setBoughtDate($boughtDate): void
    {
        $this->boughtDate = $boughtDate;
    }

    /**
     * @return mixed
     */
    public function getReservedDate()
    {
        return $this->reservedDate;
    }

    /**
     * @param mixed $reservedDate
     */
    public function setReservedDate($reservedDate): void
    {
        $this->reservedDate = $reservedDate;
    }








}
