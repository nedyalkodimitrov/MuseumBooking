<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScheduleRepository::class)
 */
class Schedule
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
     * @ORM\Column(type="string")
     */
    public $dayOfTheWeek;


    /**
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="schedule")
     */
    public  $tickets;

    /**
     * @ORM\ManyToOne(targetEntity="Admin", inversedBy="schedule")
     */
    public  $museum;

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
    public function getDayOfTheWeek()
    {
        return $this->dayOfTheWeek;
    }

    /**
     * @param mixed $dayOfTheWeek
     */
    public function setDayOfTheWeek($dayOfTheWeek): void
    {
        $this->dayOfTheWeek = $dayOfTheWeek;
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



}
