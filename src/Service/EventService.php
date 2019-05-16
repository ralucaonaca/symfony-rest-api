<?php
/**
 * Created by PhpStorm.
 * User: ralucaonaca-boca
 * Date: 5/15/19
 * Time: 8:28 PM
 */

namespace App\Service;


use App\DTO\EventDTO;
use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EventService
{
    private $eventRepository;

    public function __construct(EventRepository $eventRepository){
        $this->eventRepository  = $eventRepository;
    }

    public function getEvent(int $eventId): ?Event
    {
        return $this->eventRepository->find($eventId);
    }

    public function getAllEvents(): ?array
    {
        return $this->eventRepository->findAll();
    }

    public function addEvent(EventDTO $eventDTO): Event
    {
        $event = new Event();
        $event->setName($eventDTO->getName());
        $event->setNrSlots($eventDTO->getNrSlots());
        $event->setStartDate(new \DateTime($eventDTO->getStartDate()));
        $event->setEndDate(new \DateTime($eventDTO->getEndDate()));

        $this->eventRepository->save($event);

        return $event;
    }

    public function updateEvent(int $event, EventDTO $eventDTO): Event
    {
        $event->setName($eventDTO->getName());
        $event->setNrSlots($eventDTO->getNrSlots());
        $event->setStartDate(new \DateTime($eventDTO->getStartDate()));
        $event->setEndDate(new \DateTime($eventDTO->getEndDate()));

        $this->eventRepository->save($event);

        return $event;
    }

    public function deleteEvent(Event $event): void
    {
        $this->eventRepository->delete($event);
    }
}