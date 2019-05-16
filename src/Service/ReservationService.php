<?php
/**
 * Created by PhpStorm.
 * User: ralucaonaca-boca
 * Date: 5/16/19
 * Time: 11:13 AM
 */

namespace App\Service;


use App\DTO\ReservationDTO;
use App\Entity\Event;
use App\Entity\Reservation;
use App\Repository\EventRepository;
use App\Repository\ReservationRepository;

class ReservationService
{
    private $reservationRepository;
    private $eventRepository;

    public function __construct(ReservationRepository $reservationRepository, EventRepository $eventRepository){
        $this->reservationRepository  = $reservationRepository;
        $this->eventRepository        = $eventRepository;
    }


    public function makeReservation(Event $event, ReservationDTO $reservationDTO){

        $reservation = new Reservation();
        $reservation->setFirstName($reservationDTO->getFirstName());
        $reservation->setLastName($reservationDTO->getLastName());
        $reservation->setEmail($reservationDTO->getEmail());
        $reservation->setPhone($reservationDTO->getPhone());
        $reservation->setEvent($event);

        $this->reservationRepository->save($reservation);

        $event->setNrSlots($event->getNrSlots() - $reservationDTO->getNrPeople());
        $this->eventRepository->save($event);

        return $reservation;
    }

    public function getAllReservationsByEvent($eventId): ?array
    {
        return $this->reservationRepository->findBy(['event' => $eventId]);
    }

    public function getAllReservations(): ?array
    {
        return $this->reservationRepository->findAll();
    }

    public function deleteReservation(Reservation $reservation): void
    {
        $this->reservationRepository->delete($reservation);
    }

    public function getReservation(int $reservationId): ?Reservation
    {
        return $this->reservationRepository->find($reservationId);
    }
}