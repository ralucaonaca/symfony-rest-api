<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 * @ExclusionPolicy("all")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Expose
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="event")
     * @Expose
     */
    private $event;

    /**
     * @var string The first name
     *
     * @ORM\Column(type="string")
     * @Expose
     */
    private $first_name;

    /**
     * @var string The last name
     *
     * @ORM\Column(type="string")
     */
    private $last_name;

    /**
     * @var string The email
     *
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @var string The phone
     *
     * @ORM\Column(type="string")
     */
    private $phone;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEvent() : ?Event
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
    }
}
