<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity
 */
class Image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idImage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idimage;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="blob", length=65535, nullable=false)
     */
    private $content;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Hotel", inversedBy="imageimage")
     * @ORM\JoinTable(name="image_has_hotel",
     *   joinColumns={
     *     @ORM\JoinColumn(name="image_idImage", referencedColumnName="idImage")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="hotel_idHotel", referencedColumnName="idHotel")
     *   }
     * )
     */
    private $hotelhotel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Room", inversedBy="imageimage")
     * @ORM\JoinTable(name="image_has_room",
     *   joinColumns={
     *     @ORM\JoinColumn(name="image_idImage", referencedColumnName="idImage")
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
        $this->hotelhotel = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roomroom = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idimage
     *
     * @return integer
     */
    public function getIdimage()
    {
        return $this->idimage;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Image
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Add hotelhotel
     *
     * @param \AppBundle\Entity\Hotel $hotelhotel
     *
     * @return Image
     */
    public function addHotelhotel(\AppBundle\Entity\Hotel $hotelhotel)
    {
        $this->hotelhotel[] = $hotelhotel;

        return $this;
    }

    /**
     * Remove hotelhotel
     *
     * @param \AppBundle\Entity\Hotel $hotelhotel
     */
    public function removeHotelhotel(\AppBundle\Entity\Hotel $hotelhotel)
    {
        $this->hotelhotel->removeElement($hotelhotel);
    }

    /**
     * Get hotelhotel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotelhotel()
    {
        return $this->hotelhotel;
    }

    /**
     * Add roomroom
     *
     * @param \AppBundle\Entity\Room $roomroom
     *
     * @return Image
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
