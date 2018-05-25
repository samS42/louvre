<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $order_number = "";

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $ticket;

    /**
     * @ORM\Column(type="date")
     */
    protected $visit_day;

    /**
     * @ORM\Column(type="integer")
     */
    protected $nb_ticket;
    
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Users", cascade={"persist"}, inversedBy = "orders")
     */
    protected $users;
    
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }
    
    public function addUsers(Users $user)
    {
        $this->users[] = $user;
    }
    public function removeUser(Users $user)
    {
        $this->users->removeElement($user);
    }
    public function getUsers()
    {
        return $this->users;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getOrderNumber()
    {
        return $this->order_number;
    }

    public function setOrderNumber($order_number)
    {
        $this->order_number = $order_number;

        return $this;
    }

    public function getTicket()
    {
        return $this->ticket;
    }

    public function setTicket(string $ticket)
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getVisitDay()
    {
        return $this->visit_day;
    }

    public function setVisitDay($visit_day)
    {
        $this->visit_day = $visit_day;

        return $this;
    }

    public function getNbTicket()
    {
        return $this->nb_ticket;
    }

    public function setNbTicket(int $nb_ticket)
    {
        $this->nb_ticket = $nb_ticket;

        return $this;
    }
}
