<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Cassandra\Blob;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass=TripRepository::class)
 */
class Trip
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="TourOperator", inversedBy="trips")
     */
    public  $leader;

    /**
     * @ORM\ManyToMany(targetEntity="Museum")
     * @ORM\JoinTable(name="trips_museums",
     *      joinColumns={@ORM\JoinColumn(name="trip_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="museum_id", referencedColumnName="id")}
     *      )
     * @var Collection\Museum[]
     */
    private  $museums;


    /**
     * @ORM\ManyToMany(targetEntity="TourOperator")
     * @ORM\JoinTable(name="trips_tourOperators",
     *      joinColumns={@ORM\JoinColumn(name="trip_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tourOperator_id", referencedColumnName="id")}
     *      )
     * @var Collection\TourOperator[]
     */
    private  $friends;

    /**
     * @ORM\ManyToMany(targetEntity="Landmark")
     * @ORM\JoinTable(name="trips_landmarks",
     *      joinColumns={@ORM\JoinColumn(name="landmark_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tourOperator_id", referencedColumnName="id")}
     *      )
     * @var Collection\Landmark[]
     */
    private  $landmarks;


    /**
     * @ORM\Column(type="string")
     */
    public  $name;


    /**
     * @ORM\Column(type="blob")
     */
    public  $image;

    /**
     * @ORM\Column(type="string")
     */
    public  $startDate;

    /**
     * @ORM\Column(type="string")
     */
    public  $endDate;





    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLeader()
    {
        return $this->leader;
    }

    /**
     * @param mixed $leader
     */
    public function setLeader($leader): void
    {
        $this->leader = $leader;
    }

    /**
     * @return Collection\Museum[]
     */
    public function getMuseums()
    {
        return $this->museums;
    }

    /**
     * @param Collection\Museum[] $museums
     */
    public function setMuseums(array $museums): void
    {
        $this->museums = $museums;
    }

    /**
     * @return Collection\TourOperator[]
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * @param Collection\TourOperator[] $friends
     */
    public function setFriends(array $friends): void
    {
        $this->friends = $friends;
    }

    /**
     * @return Collection\Landmark[]
     */
    public function getLandmarks()
    {
        return $this->landmarks;
    }

    /**
     * @param Collection\Landmark[] $landmarks
     */
    public function setLandmarks(array $landmarks): void
    {
        $this->landmarks = $landmarks;
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
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
    }


}
