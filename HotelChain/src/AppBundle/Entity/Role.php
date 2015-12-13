<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity
 */
class Role
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idRole", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrole;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="rolerole")
     * @ORM\JoinTable(name="role_has_user",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_idRole", referencedColumnName="idRole")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_idUser", referencedColumnName="idUser")
     *   }
     * )
     */
    private $useruser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->useruser = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idrole
     *
     * @return integer
     */
    public function getIdrole()
    {
        return $this->idrole;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Role
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
     * Add useruser
     *
     * @param \AppBundle\Entity\User $useruser
     *
     * @return Role
     */
    public function addUseruser(\AppBundle\Entity\User $useruser)
    {
        $this->useruser[] = $useruser;

        return $this;
    }

    /**
     * Remove useruser
     *
     * @param \AppBundle\Entity\User $useruser
     */
    public function removeUseruser(\AppBundle\Entity\User $useruser)
    {
        $this->useruser->removeElement($useruser);
    }

    /**
     * Get useruser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUseruser()
    {
        return $this->useruser;
    }
}
