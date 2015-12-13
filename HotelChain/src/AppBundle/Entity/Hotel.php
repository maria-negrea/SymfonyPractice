<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotel
 *
 * @ORM\Table(name="hotel", indexes={@ORM\Index(name="fk_hotel_city_idx", columns={"idCity"})})
 * @ORM\Entity
 */
class Hotel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idHotel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idhotel;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberOfStars", type="integer", nullable=true)
     */
    private $numberofstars;

    /**
     * @var \City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCity", referencedColumnName="idCity")
     * })
     */
    private $idcity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Image", mappedBy="hotelhotel")
     */
    private $imageimage;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->imageimage = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idhotel
     *
     * @return integer
     */
    public function getIdhotel()
    {
        return $this->idhotel;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Hotel
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Hotel
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
     * Set description
     *
     * @param string $description
     *
     * @return Hotel
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set numberofstars
     *
     * @param integer $numberofstars
     *
     * @return Hotel
     */
    public function setNumberofstars($numberofstars)
    {
        $this->numberofstars = $numberofstars;

        return $this;
    }

    /**
     * Get numberofstars
     *
     * @return integer
     */
    public function getNumberofstars()
    {
        return $this->numberofstars;
    }

    /**
     * Set idcity
     *
     * @param \AppBundle\Entity\City $idcity
     *
     * @return Hotel
     */
    public function setIdcity(\AppBundle\Entity\City $idcity = null)
    {
        $this->idcity = $idcity;

        return $this;
    }

    /**
     * Get idcity
     *
     * @return \AppBundle\Entity\City
     */
    public function getIdcity()
    {
        return $this->idcity;
    }

    /**
     * Add imageimage
     *
     * @param \AppBundle\Entity\Image $imageimage
     *
     * @return Hotel
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
}
