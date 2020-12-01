<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements  UserInterface
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
    public $email;
     /**
      * @ORM\Column(type="string")
      */
    public $password;


    /**
     * @ORM\OneToOne(targetEntity="TourOperator", mappedBy="user")
     */
    public  $tourOperator;

    /**
     * @ORM\OneToOne(targetEntity="Museum", mappedBy="user")
     */
    public  $museum;

    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="user_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *      )
     * @var Collection\Role[]
     */
    private  $roles;


    public function getId(): ?int
    {
        return $this->id;
    }

     /**
      * @return mixed
      */
     public function getEmail()
     {
         return $this->email;
     }

     /**
      * @param mixed $email
      */
     public function setEmail($email): void
     {
         $this->email = $email;
     }

     /**
      * @return mixed
      */
     public function getPassword()
     {
         return $this->password;
     }

     /**
      * @param mixed $password
      */
     public function setPassword($password): void
     {
         $this->password = $password;
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



    public function getRoles()
    {
        $roles = [];
        foreach ( $this->roles as $role ) {
            $roles[] = $role->getName();
        }

        return $roles;
    }

    /**
     * @param Collection\Role[] $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }



    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
