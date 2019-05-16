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

class ReservationDTO
{

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @var string
     * @Type("string")
     */
    private $first_name;

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @var string
     * @Type("string")
     */
    private $last_name;

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @var string
     * @Type("string")
     */
    private $email;

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @var string
     * @Type("string")
     */
    private $phone;

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @var int
     * @Type("integer")
     */
    private $nr_people;

    /**
     * ReservationDTO constructor.
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $phone
     */
    public function __construct(string $first_name, string $last_name, string $email, string $phone, int $nr_people)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->nr_people = $nr_people;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return int
     */
    public function getNrPeople(): int
    {
        return $this->nr_people;
    }
}