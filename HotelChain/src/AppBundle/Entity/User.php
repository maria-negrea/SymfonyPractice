<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=45, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=45, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=45, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="telephoneNumber", type="string", length=25, nullable=false)
     */
    private $telephonenumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isBlocked", type="boolean", nullable=false)
     */
    private $isblocked;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Role", mappedBy="useruser")
     */
    private $rolerole;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rolerole = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get iduser
     *
     * @return integer
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set telephonenumber
     *
     * @param string $telephonenumber
     *
     * @return User
     */
    public function setTelephonenumber($telephonenumber)
    {
        $this->telephonenumber = $telephonenumber;

        return $this;
    }

    /**
     * Get telephonenumber
     *
     * @return string
     */
    public function getTelephonenumber()
    {
        return $this->telephonenumber;
    }

    /**
     * Set isblocked
     *
     * @param boolean $isblocked
     *
     * @return User
     */
    public function setIsblocked($isblocked)
    {
        $this->isblocked = $isblocked;

        return $this;
    }

    /**
     * Get isblocked
     *
     * @return boolean
     */
    public function getIsblocked()
    {
        return $this->isblocked;
    }

    /**
     * Add rolerole
     *
     * @param \AppBundle\Entity\Role $rolerole
     *
     * @return User
     */
    public function addRolerole(\AppBundle\Entity\Role $rolerole)
    {
        $this->rolerole[] = $rolerole;

        return $this;
    }

    /**
     * Remove rolerole
     *
     * @param \AppBundle\Entity\Role $rolerole
     */
    public function removeRolerole(\AppBundle\Entity\Role $rolerole)
    {
        $this->rolerole->removeElement($rolerole);
    }

    /**
     * Get rolerole
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRolerole()
    {
        return $this->rolerole;
    }
}
