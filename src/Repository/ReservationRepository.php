<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function save(Reservation $reservation)
    {
        // _em is EntityManager which is DI by the base class
        $this->_em->persist($reservation);
        $this->_em->flush();
    }

    public function delete(Reservation $reservation)
    {
        // _em is EntityManager which is DI by the base class
        $this->_em->remove($reservation);
        $this->_em->flush();
    }
}
