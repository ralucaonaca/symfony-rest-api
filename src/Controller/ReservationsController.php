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

class ReservationsController extends AbstractFOSRestController
{
    private $reservationService = null;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService   = $reservationService;
    }

    /**
     * Gets all reservations
     * @Rest\Get("/reservations")
     */

    public function getReservations() : View
    {
        $reservations = $this->reservationService->getAllReservations();
        return View::create($reservations, Response::HTTP_OK , []);
    }

    /**
     * Retrieves an Reservation resource
     * @Rest\Get("/reservations/{reservationId}")
     */
    public function getReservation(int $reservationId): View
    {
        $reservation = $this->reservationService->getReservation($reservationId);

        if (null == $reservation){
            $errors = [
                'propertyPath' => 'reservation',
                'message'      => 'The Reservation was not found'
            ];
            return View::create($errors, Response::HTTP_NOT_FOUND);
        }

        return View::create($reservation, Response::HTTP_OK);
    }

    /**
     * Removes the Reservation resource
     * @Rest\Delete("/reservations/{reservationId}")
     */
    public function deleteReservation(int $reservationId): View
    {
        $reservation = $this->reservationService->getReservation($reservationId);

        if (null == $reservation){
            $errors = [
                'propertyPath' => 'reservation',
                'message'      => 'The Reservation was not found'
            ];
            return View::create($errors, Response::HTTP_NOT_FOUND);
        }

        $this->reservationService->deleteReservation($reservation);

        return View::create(true, Response::HTTP_NO_CONTENT);
    }
}