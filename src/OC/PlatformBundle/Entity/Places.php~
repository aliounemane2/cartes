<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Places
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Entity\PlacesRepository")
 */
class Places
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
     * @ORM\Column(name="nomp", type="string", length=255)
     */
    private $nomp;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Categorie" , inversedBy="places",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

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
     * Set nomp
     *
     * @param string $nomp
     * @return Places
     */
    public function setNomp($nomp)
    {
        $this->nomp = $nomp;

        return $this;
    }

    /**
     * Get nomp
     *
     * @return string 
     */
    public function getNomp()
    {
        return $this->nomp;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return Places
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return Places
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
    

    /**
     * Get categorie
     *
     * @return \OC\PlatformBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set categorie
     *
     * @param \OC\PlatformBundle\Entity\Categorie $categorie
     * @return Places
     */
    public function setCategorie(\OC\PlatformBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }
}
