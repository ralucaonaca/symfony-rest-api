<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @ExclusionPolicy("all")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @Expose
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="event", cascade={"remove"})
     */
    private $reservations;

    /**
     * @var string The name of the event
     *
     * @ORM\Column(type="string")
     * @Expose
     */
    private $name;

    /**
     * @var int The number of slots available for an event
     *
     * @ORM\Column(type="integer")
     * @Expose
     */
    private $nr_slots;

    /**
     * @var string A "Y-m-d H:i:s" formatted value. The start date of the event.
     *
     * @ORM\Column(type="datetime")
     * @Expose
     */
    private $start_date;

    /**
     * @var string A "Y-m-d H:i:s" formatted value. The end date of the event.
     * @ORM\Column(type="datetime")
     * @Expose
     */
    private $end_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNrSlots(): int
    {
        return $this->nr_slots;
    }

    /**
     * @param int $nr_slots
     */
    public function setNrSlots(int $nr_slots): void
    {
        $this->nr_slots = $nr_slots;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getStartDate(): \DateTimeInterface
    {
        return $this->start_date;
    }

    /**
     * @var string A "Y-m-d H:i:s" formatted value
     * @param \DateTimeInterface $start_date
     */
    public function setStartDate(\DateTimeInterface $start_date): void
    {
        $this->start_date = $start_date;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getEndDate(): \DateTimeInterface
    {
        return $this->end_date;
    }

    /**
     * @param \DateTimeInterface $end_date
     */
    public function setEndDate(\DateTimeInterface $end_date): void
    {
        $this->end_date = $end_date;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getReservations() : \Doctrine\Common\Collections\Collection
    {
        return $this->reservations;
    }

    /**
     * @param mixed $reservations
     */
    public function setReservations($reservations): \Doctrine\Common\Collections\ArrayCollection
    {
        $this->reservations = $reservations;
    }
}
