<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Orders", cascade={"persist"}, inversedBy = "users")
     */
    protected $orders;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(min=3)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(min=3)
     */
    protected $surname;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     */
    protected $birth_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $type_price = "";

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $email;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $discount;

    /**
     * @ORM\Column(type="integer")
     */
    protected $price = 0;
    
    protected $nb_form = 1;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function addOrder(Orders $order)
    {
        $this->orders[] = $order;
    }
    public function removeOrder(Orders $order)
    {
        $this->orders->removeElement($order);
    }
    public function getOrders()
    {
        return $this->orders;
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
