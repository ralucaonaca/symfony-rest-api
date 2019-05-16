<?php
/**
 * Created by PhpStorm.
 * User: ralucaonaca-boca
 * Date: 5/14/19
 * Time: 11:56 AM
 */

namespace App\Controller;

use App\DTO\EventDTO;
use App\DTO\ReservationDTO;
use App\Service\EventService;
use App\Service\ReservationService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class EventsController extends AbstractFOSRestController
{
    private $eventService = null;
    private $reservationService = null;

    public function __construct(EventService $eventService, ReservationService $reservationService)
    {
        $this->eventService         = $eventService;
        $this->reservationService   = $reservationService;
    }

    /**
     * Gets all events
     * @Rest\Get("/events")
     */

    public function getEvents() : View
    {
        $events = $this->eventService->getAllEvents();
        return View::create($events, Response::HTTP_OK , []);
    }

    /**
     * Retrieves an Event resource
     * @Rest\Get("/events/{eventId}")
     */
    public function getEvent(int $eventId): View
    {
        $event = $this->eventService->getEvent($eventId);

        if (null == $event){
            $errors = [
                'propertyPath' => 'event',
                'message'      => 'The Event was not found.'
            ];
            return View::create($errors, Response::HTTP_NOT_FOUND);
        }

        return View::create($event, Response::HTTP_OK);
    }

    /**
     * Creates an event
     *
     * @Rest\Post("/events")
     * @ParamConverter("eventDTO", converter="fos_rest.request_body")
     * @param EventDTO eventDTO
     * @return View
     */

    public function postEvent(EventDTO $eventDTO, ConstraintViolationListInterface $validationErrors): View
    {
        if (count($validationErrors) > 0) {
            return View::create($validationErrors, Response::HTTP_BAD_REQUEST);
        }

        $event = $this->eventService->addEvent($eventDTO);

        if (null === $event){
            $errors = [
                'propertyPath' => 'event',
                'message'      => 'The Event was not created'
            ];
            return View::create($errors, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return View::create($event, Response::HTTP_CREATED);
    }

    /**
     * Replaces Event resource
     * @Rest\Put("/events/{eventId}")
     * @ParamConverter("eventDTO", converter="fos_rest.request_body")
     * @param EventDTO eventDTO
     * @return View
     */
    public function putEvent(int $eventId, EventDTO $eventDTO, ConstraintViolationListInterface $validationErrors): View
    {
        if (count($validationErrors) > 0) {
            return View::create($validationErrors, Response::HTTP_BAD_REQUEST);
        }


        $event = $this->eventService->updateEvent($eventId, $eventDTO);

        if (null === $event){
            $errors = [
                'propertyPath' => 'event',
                'message'      => 'The Event was not updated'
            ];
            return View::create($errors, Response::HTTP_NOT_FOUND);
        }

        return View::create($event, Response::HTTP_OK);
    }

    /**
     * Removes the Event resource
     * @Rest\Delete("/events/{eventId}")
     */
    public function deleteEvent(int $eventId): View
    {
        $event = $this->eventService->getEvent($eventId);

        if (null === $event){
            $errors = [
                'propertyPath' => 'event',
                'message'      => 'The Event was not found'
            ];
            return View::create($errors, Response::HTTP_NOT_FOUND);
        }

        $this->eventService->deleteEvent($event);

        return View::create(true, Response::HTTP_NO_CONTENT);
    }

    /**
     * Removes the Event resource
     * @Rest\Post("/events/{eventId}/reservation")
     * * @ParamConverter("reservationDTO", converter="fos_rest.request_body")
     * @param ReservationDTO reservationDTO
     */
    public function makeReservation(int $eventId, ReservationDTO $reservationDTO, ConstraintViolationListInterface $validationErrors): View
    {
        if (count($validationErrors) > 0) {
            return View::create($validationErrors, Response::HTTP_BAD_REQUEST);
        }

        $event = $this->eventService->getEvent($eventId);

        if (null === $event){
            $errors = [
                'propertyPath' => 'event',
                'message'      => 'The Event was not found'
            ];
            return View::create($errors, Response::HTTP_NOT_FOUND);
        }

        if ($event->getNrSlots() - $reservationDTO->getNrPeople() < 0){
            $errors = [
                'propertyPath' => 'event',
                'message'      => 'You can not make a reservation for the number of people'
            ];
            return View::create($errors, Response::HTTP_NOT_FOUND);
        }

        $reservation = $this->reservationService->makeReservation($event, $reservationDTO);

        if (null === $reservation){
            $errors = [
                'propertyPath' => 'reservation',
                'message'      => 'The Reservation was not save'
            ];
            return View::create($errors, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return View::create($reservation, Response::HTTP_OK);

    }

    /**
     * Retrieves an Event resource
     * @Rest\Get("/events/{eventId}/reservations")
     */
    public function getEventReservations(int $eventId): View
    {
        $event = $this->eventService->getEvent($eventId);

        if (null == $event){
            $errors = [
                'propertyPath' => 'event',
                'message'      => 'The Event was not found'
            ];
            return View::create($errors, Response::HTTP_NOT_FOUND);
        }

        $reservations = $this->reservationService->getAllReservationsByEvent($eventId);

        if (null == $reservations){
            return View::create([], Response::HTTP_NOT_FOUND);
        }

        return View::create($reservations, Response::HTTP_OK);
    }
}