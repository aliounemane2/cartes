<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zone
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Entity\ZoneRepository")
 */
class Zone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="OC\PlatformBundle\Entity\Limite", mappedBy="zone")
     * @ORM\JoinColumn(nullable=false)
     */
    private $limite;

    /**
     * @ORM\OneToMany(targetEntity="OC\PlatformBundle\Entity\Affectation", mappedBy="zone")
     * @ORM\JoinColumn(nullable=false)
     */
    private $affectation;

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
     * Set nom
     *
     * @param string $nom
     * @return Zone
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->limite = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add limite
     *
     * @param \OC\PlatformBundle\Entity\Limite $limite
     * @return Zone
     */
    public function addLimite(\OC\PlatformBundle\Entity\Limite $limite)
    {
        $this->limite[] = $limite;

        return $this;
    }

    /**
     * Remove limite
     *
     * @param \OC\PlatformBundle\Entity\Limite $limite
     */
    public function removeLimite(\OC\PlatformBundle\Entity\Limite $limite)
    {
        $this->limite->removeElement($limite);
    }

    /**
     * Get limite
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLimite()
    {
        return $this->limite;
    }

    /**
     * Add affectation
     *
     * @param \OC\PlatformBundle\Entity\Affectation $affectation
     * @return Zone
     */
    public function addAffectation(\OC\PlatformBundle\Entity\Affectation $affectation)
    {
        $this->affectation[] = $affectation;

        return $this;
    }

    /**
     * Remove affectation
     *
     * @param \OC\PlatformBundle\Entity\Affectation $affectation
     */
    public function removeAffectation(\OC\PlatformBundle\Entity\Affectation $affectation)
    {
        $this->affectation->removeElement($affectation);
    }

    /**
     * Get affectation
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAffectation()
    {
        return $this->affectation;
    }
}
