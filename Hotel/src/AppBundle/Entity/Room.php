<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room", indexes={@ORM\Index(name="fk_room_roomtype_idx", columns={"room_type_id"})})
 * @ORM\Entity
 */
class Room
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=45, nullable=false)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="price_per_night", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $pricePerNight;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_wireless", type="boolean", nullable=false)
     */
    private $hasWireless;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_air_conditioning", type="boolean", nullable=false)
     */
    private $hasAirConditioning;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_tv", type="boolean", nullable=false)
     */
    private $hasTv;

    /**
     * @var boolean
     *
     * @ORM\Column(name="has_minibar", type="boolean", nullable=false)
     */
    private $hasMinibar;

    /**
     * @var \RoomType
     *
     * @ORM\ManyToOne(targetEntity="RoomType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room_type_id", referencedColumnName="id")
     * })
     */
    private $roomType;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return Room
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set pricePerNight
     *
     * @param string $pricePerNight
     *
     * @return Room
     */
    public function setPricePerNight($pricePerNight)
    {
        $this->pricePerNight = $pricePerNight;

        return $this;
    }

    /**
     * Get pricePerNight
     *
     * @return string
     */
    public function getPricePerNight()
    {
        return $this->pricePerNight;
    }

    /**
     * Set hasWireless
     *
     * @param boolean $hasWireless
     *
     * @return Room
     */
    public function setHasWireless($hasWireless)
    {
        $this->hasWireless = $hasWireless;

        return $this;
    }

    /**
     * Get hasWireless
     *
     * @return boolean
     */
    public function getHasWireless()
    {
        return $this->hasWireless;
    }

    /**
     * Set hasAirConditioning
     *
     * @param boolean $hasAirConditioning
     *
     * @return Room
     */
    public function setHasAirConditioning($hasAirConditioning)
    {
        $this->hasAirConditioning = $hasAirConditioning;

        return $this;
    }

    /**
     * Get hasAirConditioning
     *
     * @return boolean
     */
    public function getHasAirConditioning()
    {
        return $this->hasAirConditioning;
    }

    /**
     * Set hasTv
     *
     * @param boolean $hasTv
     *
     * @return Room
     */
    public function setHasTv($hasTv)
    {
        $this->hasTv = $hasTv;

        return $this;
    }

    /**
     * Get hasTv
     *
     * @return boolean
     */
    public function getHasTv()
    {
        return $this->hasTv;
    }

    /**
     * Set hasMinibar
     *
     * @param boolean $hasMinibar
     *
     * @return Room
     */
    public function setHasMinibar($hasMinibar)
    {
        $this->hasMinibar = $hasMinibar;

        return $this;
    }

    /**
     * Get hasMinibar
     *
     * @return boolean
     */
    public function getHasMinibar()
    {
        return $this->hasMinibar;
    }

    /**
     * Set roomType
     *
     * @param \AppBundle\Entity\RoomType $roomType
     *
     * @return Room
     */
    public function setRoomType(\AppBundle\Entity\RoomType $roomType = null)
    {
        $this->roomType = $roomType;

        return $this;
    }

    /**
     * Get roomType
     *
     * @return \AppBundle\Entity\RoomType
     */
    public function getRoomType()
    {
        return $this->roomType;
    }
    
    public function __toString()
    {
    	return $this->getNumber();
    }
}
