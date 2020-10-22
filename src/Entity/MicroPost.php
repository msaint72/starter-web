<?php

namespace App\Entity;

use App\Repository\MicroPostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MicroPostRepository::class)
 */
class MicroPost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column (type="string",length=280)
     * @Assert\NotBlank()
     * @Assert\Length(min=10,minMessage="biraz daha...")
     */
    private $text;

    /**
     * @ORM\Column (type="datetime")
     */

    private $time;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User",inversedBy="posts")
     * @ORM\JoinColumn()
     */
    private $user;
    public function getId(): int
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
    public function setText($text)
    {
        $this->text = $text;
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
    public function setTime($time)
    {
        $this->time = $time;
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
    public function setUser($user)
    {
        $this->user = $user;
    }

}
