<?php
/**
 * Created by PhpStorm.
 * User: ralucaonaca-boca
 * Date: 5/15/19
 * Time: 9:31 PM
 */

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Type;

class EventDTO
{

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @var string
     * @Type("string")
     */
    private $name;

    /**
     * @Assert\NotNull
     * @var int
     * @Type("integer")
     */
    private $nr_slots;

    /**
     * @Assert\DateTime
     * @var string A "Y-m-d H:i:s" formatted value
     * @var string
     * @Type("string")
     */
    private $start_date;

    /**
     * @Assert\DateTime
     * @var string A "Y-m-d H:i:s" formatted value
     * @var string
     * @Type("string")
     */
    private $end_date;

    /**
     * EventDTO constructor.
     * @param int $nr_slots
     * @param string $start_date
     * @param string $end_date
     */
    public function __construct(string $name, int $nr_slots, string $start_date, string $end_date)
    {
        $this->name = $name;
        $this->nr_slots = $nr_slots;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @return int
     */
    public function getNrSlots(): int
    {
        return $this->nr_slots;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->start_date;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->end_date;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}