<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
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
    public $path;


    /**
     * @ORM\ManyToOne(targetEntity="Museum", inversedBy="images")
     */
    public  $museum;




    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
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
