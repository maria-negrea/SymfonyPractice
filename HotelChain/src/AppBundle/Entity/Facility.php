<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facility
 *
 * @ORM\Table(name="facility")
 * @ORM\Entity
 */
class Facility
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idFacility", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfacility;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Room", inversedBy="facilityfacility")
     * @ORM\JoinTable(name="facility_has_room",
     *   joinColumns={
     *     @ORM\JoinColumn(name="facility_idFacility", referencedColumnName="idFacility")
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
     * Get idfacility
     *
     * @return integer
     */
    public function getIdfacility()
    {
        return $this->idfacility;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Facility
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add roomroom
     *
     * @param \AppBundle\Entity\Room $roomroom
     *
     * @return Facility
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
