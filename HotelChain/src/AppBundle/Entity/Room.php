<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room", indexes={@ORM\Index(name="fk_room_hotel_idx", columns={"idHotel"}), @ORM\Index(name="fk_room_roomtype_idx", columns={"idRoomType"})})
 * @ORM\Entity
 */
class Room
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idRoom", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idroom;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=45, nullable=false)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var \Hotel
     *
     * @ORM\ManyToOne(targetEntity="Hotel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idHotel", referencedColumnName="idHotel")
     * })
     */
    private $idhotel;

    /**
     * @var \Roomtype
     *
     * @ORM\ManyToOne(targetEntity="Roomtype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRoomType", referencedColumnName="idRoomType")
     * })
     */
    private $idroomtype;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Facility", mappedBy="roomroom")
     */
    private $facilityfacility;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Image", mappedBy="roomroom")
     */
    private $imageimage;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Offer", mappedBy="roomroom")
     */
    private $offeroffer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->facilityfacility = new \Doctrine\Common\Collections\ArrayCollection();
        $this->imageimage = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offeroffer = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idroom
     *
     * @return integer
     */
    public function getIdroom()
    {
        return $this->idroom;
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
     * Set price
     *
     * @param string $price
     *
     * @return Room
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set idhotel
     *
     * @param \AppBundle\Entity\Hotel $idhotel
     *
     * @return Room
     */
    public function setIdhotel(\AppBundle\Entity\Hotel $idhotel = null)
    {
        $this->idhotel = $idhotel;

        return $this;
    }

    /**
     * Get idhotel
     *
     * @return \AppBundle\Entity\Hotel
     */
    public function getIdhotel()
    {
        return $this->idhotel;
    }

    /**
     * Set idroomtype
     *
     * @param \AppBundle\Entity\Roomtype $idroomtype
     *
     * @return Room
     */
    public function setIdroomtype(\AppBundle\Entity\Roomtype $idroomtype = null)
    {
        $this->idroomtype = $idroomtype;

        return $this;
    }

    /**
     * Get idroomtype
     *
     * @return \AppBundle\Entity\Roomtype
     */
    public function getIdroomtype()
    {
        return $this->idroomtype;
    }

    /**
     * Add facilityfacility
     *
     * @param \AppBundle\Entity\Facility $facilityfacility
     *
     * @return Room
     */
    public function addFacilityfacility(\AppBundle\Entity\Facility $facilityfacility)
    {
        $this->facilityfacility[] = $facilityfacility;

        return $this;
    }

    /**
     * Remove facilityfacility
     *
     * @param \AppBundle\Entity\Facility $facilityfacility
     */
    public function removeFacilityfacility(\AppBundle\Entity\Facility $facilityfacility)
    {
        $this->facilityfacility->removeElement($facilityfacility);
    }

    /**
     * Get facilityfacility
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacilityfacility()
    {
        return $this->facilityfacility;
    }

    /**
     * Add imageimage
     *
     * @param \AppBundle\Entity\Image $imageimage
     *
     * @return Room
     */
    public function addImageimage(\AppBundle\Entity\Image $imageimage)
    {
        $this->imageimage[] = $imageimage;

        return $this;
    }

    /**
     * Remove imageimage
     *
     * @param \AppBundle\Entity\Image $imageimage
     */
    public function removeImageimage(\AppBundle\Entity\Image $imageimage)
    {
        $this->imageimage->removeElement($imageimage);
    }

    /**
     * Get imageimage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImageimage()
    {
        return $this->imageimage;
    }

    /**
     * Add offeroffer
     *
     * @param \AppBundle\Entity\Offer $offeroffer
     *
     * @return Room
     */
    public function addOfferoffer(\AppBundle\Entity\Offer $offeroffer)
    {
        $this->offeroffer[] = $offeroffer;

        return $this;
    }

    /**
     * Remove offeroffer
     *
     * @param \AppBundle\Entity\Offer $offeroffer
     */
    public function removeOfferoffer(\AppBundle\Entity\Offer $offeroffer)
    {
        $this->offeroffer->removeElement($offeroffer);
    }

    /**
     * Get offeroffer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOfferoffer()
    {
        return $this->offeroffer;
    }
}
