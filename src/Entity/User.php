<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements  UserInterface,\Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @@ORM\Column (type="string",length=50,unique=true)
     */
    private $username;
    /**
     * @ORM\Column (type="string")
     */
    private $password;
    /**
     * @ORM\Column (type="string",length=254,unique=true)
     */
    private $email;
    /**
     * @var @ORM\Column(type="string",length=50)
     */
    private $fullname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoles()
    {
        return [
          'ROLE_USER'
        ];
    }

    public function getPassword()
    {
        return $this->getPassword();

    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->getUsername();
    }

    public function eraseCredentials()
    {

    }

    public function serialize()
    {
       return $this->serialize(
       [
           $this->id,$this->username,$this->password
       ]
       );
    }

    public function unserialize($serialized)
    {
        list($this->id,$this->username,$this->password)=$this->unserialize($serialized);
    }

}
