<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity
 */
class Offer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idOffer", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idoffer;

    /**
     * @var float
     *
     * @ORM\Column(name="discount", type="float", precision=10, scale=0, nullable=true)
     */
    private $discount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="date", nullable=false)
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="date", nullable=false)
     */
    private $enddate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Room", inversedBy="offeroffer")
     * @ORM\JoinTable(name="offer_has_room",
     *   joinColumns={
     *     @ORM\JoinColumn(name="offer_idOffer", referencedColumnName="idOffer")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="room_idRoom", referencedColumnName="idRoom")
     *   }
     * )
     */
    private $roomroom;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roomroom = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idoffer
     *
     * @return integer
     */
    public function getIdoffer()
    {
        return $this->idoffer;
    }

    /**
     * Set discount
     *
     * @param float $discount
     *
     * @return Offer
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return Offer
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return Offer
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate
     *
     * @return \DateTime
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * Add roomroom
     *
     * @param \AppBundle\Entity\Room $roomroom
     *
     * @return Offer
     */
    public function addRoomroom(\AppBundle\Entity\Room $roomroom)
    {
        $this->roomroom[] = $roomroom;

        return $this;
    }

    /**
     * Remove roomroom
     *
     * @param \AppBundle\Entity\Room $roomroom
     */
    public function removeRoomroom(\AppBundle\Entity\Room $roomroom)
    {
        $this->roomroom->removeElement($roomroom);
    }

    /**
     * Get roomroom
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoomroom()
    {
        return $this->roomroom;
    }
}
