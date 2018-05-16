<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NewOrder")
     * @ORM\JoinColumn(nullable=false)
     */
    private $new_order;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(min=3)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(min=3)
     */
    private $surname;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     */
    private $birth_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_price = "";

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $discount;

    /**
     * @ORM\Column(type="integer")
     */
    private $price = 0;

    public function differenceBetweenBirthdateAndNow($birthdate)
    {
        $now = date_create();
        $interval = date_diff($birthdate, $now);
        $age = $interval->format('%y');
        $age = (int)$age;

        if($age < 4)
            return 'Tarif gratuit';

        elseif ($age <= 12)
            return 'Tarif enfant';

        elseif($age > 12 AND $age < 60 )
            return 'Tarif normal';

        elseif($age >= 60)
            return 'Tarif senior';
    }

    public function typeOfPriceToPrice($typeOfPrice)
    {
        if($typeOfPrice == "Tarif gratuit")
            return $price = 0;

        elseif($typeOfPrice == "Tarif enfant")
            return $price = 8;

        elseif($typeOfPrice == "Tarif normal")
            return $price = 16;

        elseif($typeOfPrice == "Tarif senior")
            return $price = 12;

        elseif($typeOfPrice == "Tarif demi-journée")
            return $price = 8;

        elseif($typeOfPrice == "Tarif réduit")
            return $price = 10;
    }

    public function getTypePrice()
    {
        return $this->type_price;
    }

    public function setTypePrice(string $type_price)
    {
        $this->type_price = $type_price;

        return $this;
    }

    public function setNewOrder(NewOrder $newOrder)
    {
        $this->new_order = $newOrder;
    }
    public function getNewOrder()
    {
        return $this->new_order;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname()
    {
        return $this->surname;
    }
    public function setSurname(string $surname)
    {
        $this->surname = $surname;

        return $this;
    }

    public function getBirthDate()
    {
        return $this->birth_date;
    }
    public function setBirthDate($birth_date)
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }
    public function setCountry(string $country)
    {
        $this->country = $country;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function setDiscount(bool $discount)
    {
        $this->discount = $discount;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
}
