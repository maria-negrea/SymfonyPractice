<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roomtype
 *
 * @ORM\Table(name="roomtype")
 * @ORM\Entity
 */
class Roomtype
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idRoomType", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idroomtype;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;



    /**
     * Get idroomtype
     *
     * @return integer
     */
    public function getIdroomtype()
    {
        return $this->idroomtype;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Roomtype
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
}
