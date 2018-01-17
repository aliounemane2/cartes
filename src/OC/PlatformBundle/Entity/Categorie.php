<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Entity\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="nomc", type="string", length=255)
     */
    private $nomc;


    /**
     * @ORM\OneToMany(targetEntity="OC\PlatformBundle\Entity\Places", mappedBy="categorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $places;

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
     * Set nomc
     *
     * @param string $nom
     * @return Categorie
     */
    public function setNomc($nomc)
    {
        $this->nomc = $nomc;

        return $this;
    }

    /**
     * Get nomc
     *
     * @return string 
     */
    public function getNomc()
    {
        return $this->nomc;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->places = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Add places
     *
     * @param \OC\PlatformBundle\Entity\Places $places
     * @return Categorie
     */
    public function addPlace(\OC\PlatformBundle\Entity\Places $places)
    {
        $this->places[] = $places;

        return $this;
    }

    /**
     * Remove places
     *
     * @param \OC\PlatformBundle\Entity\Places $places
     */
    public function removePlace(\OC\PlatformBundle\Entity\Places $places)
    {
        $this->places->removeElement($places);
    }

    /**
     * Get places
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlaces()
    {
        return $this->places;
    }
}
