<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function save(Event $event)
    {
        // _em is EntityManager which is DI by the base class
        $this->_em->persist($event);
        $this->_em->flush();
    }

    public function delete(Event $event)
    {
        // _em is EntityManager which is DI by the base class
        $this->_em->remove($event);
        $this->_em->flush();
    }
}
