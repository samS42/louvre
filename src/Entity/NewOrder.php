<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewOrderRepository")
 */
class NewOrder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $order_number = "";

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ticket;

    /**
     * @ORM\Column(type="date")
     */
    private $visit_day;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_ticket;


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
