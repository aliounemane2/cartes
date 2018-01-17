<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Affectation
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
     * @ORM\Column(name="event", type="string", length=100)
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Zone" , inversedBy="affectation",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $zone;

    /**
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Commercial" , inversedBy="affectation",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commercial;

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
     * Set event
     *
     * @param string $event
     * @return Affectation
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return string 
     */
    public function getEvent()
    {
        return $this->event;
    }


    
    /**
     * Set zone
     *
     * @param \OC\PlatformBundle\Entity\Zone $zone
     * @return Affectation
     */
    public function setZone(\OC\PlatformBundle\Entity\Zone $zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return \OC\PlatformBundle\Entity\Zone 
     */
    public function getZone()
    {
        return $this->zone;
    }


    /**
     * Set commercial
     *
     * @param \OC\PlatformBundle\Entity\Commercial $commercial
     * @return Affectation
     */
    public function setCommercial(\OC\PlatformBundle\Entity\Commercial $commercial)
    {
        $this->commercial = $commercial;

        return $this;
    }

    /**
     * Get commercial
     *
     * @return \OC\PlatformBundle\Entity\Commercial 
     */
    public function getCommercial()
    {
        return $this->commercial;
    }
}
