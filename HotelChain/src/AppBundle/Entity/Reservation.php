<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="fk_reservation_room_idx", columns={"idRoom"}), @ORM\Index(name="fk_reservation_user_idx", columns={"idUser"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idReservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="checkInDate", type="datetime", nullable=false)
     */
    private $checkindate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="checkOutDate", type="datetime", nullable=false)
     */
    private $checkoutdate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isCanceled", type="boolean", nullable=false)
     */
    private $iscanceled;

    /**
     * @var \Room
     *
     * @ORM\ManyToOne(targetEntity="Room")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRoom", referencedColumnName="idRoom")
     * })
     */
    private $idroom;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idUser")
     * })
     */
    private $iduser;



    /**
     * Get idreservation
     *
     * @return integer
     */
    public function getIdreservation()
    {
        return $this->idreservation;
    }

    /**
     * Set checkindate
     *
     * @param \DateTime $checkindate
     *
     * @return Reservation
     */
    public function setCheckindate($checkindate)
    {
        $this->checkindate = $checkindate;

        return $this;
    }

    /**
     * Get checkindate
     *
     * @return \DateTime
     */
    public function getCheckindate()
    {
        return $this->checkindate;
    }

    /**
     * Set checkoutdate
     *
     * @param \DateTime $checkoutdate
     *
     * @return Reservation
     */
    public function setCheckoutdate($checkoutdate)
    {
        $this->checkoutdate = $checkoutdate;

        return $this;
    }

    /**
     * Get checkoutdate
     *
     * @return \DateTime
     */
    public function getCheckoutdate()
    {
        return $this->checkoutdate;
    }

    /**
     * Set iscanceled
     *
     * @param boolean $iscanceled
     *
     * @return Reservation
     */
    public function setIscanceled($iscanceled)
    {
        $this->iscanceled = $iscanceled;

        return $this;
    }

    /**
     * Get iscanceled
     *
     * @return boolean
     */
    public function getIscanceled()
    {
        return $this->iscanceled;
    }

    /**
     * Set idroom
     *
     * @param \AppBundle\Entity\Room $idroom
     *
     * @return Reservation
     */
    public function setIdroom(\AppBundle\Entity\Room $idroom = null)
    {
        $this->idroom = $idroom;

        return $this;
    }

    /**
     * Get idroom
     *
     * @return \AppBundle\Entity\Room
     */
    public function getIdroom()
    {
        return $this->idroom;
    }

    /**
     * Set iduser
     *
     * @param \AppBundle\Entity\User $iduser
     *
     * @return Reservation
     */
    public function setIduser(\AppBundle\Entity\User $iduser = null)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return \AppBundle\Entity\User
     */
    public function getIduser()
    {
        return $this->iduser;
    }
}
