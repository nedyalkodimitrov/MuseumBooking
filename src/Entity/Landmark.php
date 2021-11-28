<?php

namespace App\Entity;

use App\Repository\LandmarksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LandmarksRepository::class)
 */
class Landmark
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    public $rating;


    /**
     * @ORM\Column(type="string")
     */
    public $name;

    /**
     * @ORM\Column(type="string")
     */
    public $additionalInformation;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="museums")
     */
    public  $city;

    /**
     * @ORM\Column(type="string")
     */
    public $image;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="museum")
     */
    public  $images;

    /**
     * @ORM\OneToMany(targetEntity="MuseumReview", mappedBy="museum")
     */
    public  $reviews;

    /**
     * @ORM\OneToMany(targetEntity="WishList", mappedBy="landmark")
     */
    public  $wishList;

    /**
     * @ORM\Column(type="string")
     */
    public $latitude;

    /**
     * @ORM\Column(type="string")
     */
    public $longitude;


    public function getId(): ?int
    {
        return $this->id;
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
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param mixed $reviews
     */
    public function setReviews($reviews): void
    {
        $this->reviews = $reviews;
    }

    /**
     * @return mixed
     */
    public function getWishList()
    {
        return $this->wishList;
    }

    /**
     * @param mixed $wishList
     */
    public function setWishList($wishList): void
    {
        $this->wishList = $wishList;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }




}
