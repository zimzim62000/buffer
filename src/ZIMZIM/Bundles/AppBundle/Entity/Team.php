<?php

namespace ZIMZIM\Bundles\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Team
 *
 * @ORM\Table(name="parierentreamis_team")
 * @ORM\Entity
 */
class Team
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(visible=false, sortable=false, filterable=false)
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @GRID\Column(title="entity.app.tournament.name",operatorsVisible=false)
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @GRID\Column(operatorsVisible=false, visible=false)
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @GRID\Column(operatorsVisible=false, visible=false)
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\Game", mappedBy="teamHome")
     */
    private $gamesHome;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\Game", mappedBy="teamOuter")
     */
    private $gamesOuter;


    public function __construct(){
        $this->gamesHome = new ArrayCollection();
        $this->gamesOuter =  new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Team
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Team
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Team
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add gamesHome
     *
     * @param \ZIMZIM\Bundles\AppBundle\Entity\Game $gamesHome
     * @return Team
     */
    public function addGamesHome(\ZIMZIM\Bundles\AppBundle\Entity\Game $gamesHome)
    {
        $this->gamesHome[] = $gamesHome;

        return $this;
    }

    /**
     * Remove gamesHome
     *
     * @param \ZIMZIM\Bundles\AppBundle\Entity\Game $gamesHome
     */
    public function removeGamesHome(\ZIMZIM\Bundles\AppBundle\Entity\Game $gamesHome)
    {
        $this->gamesHome->removeElement($gamesHome);
    }

    /**
     * Get gamesHome
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGamesHome()
    {
        return $this->gamesHome;
    }

    /**
     * Add gamesOuter
     *
     * @param \ZIMZIM\Bundles\AppBundle\Entity\Game $gamesOuter
     * @return Team
     */
    public function addGamesOuter(\ZIMZIM\Bundles\AppBundle\Entity\Game $gamesOuter)
    {
        $this->gamesOuter[] = $gamesOuter;

        return $this;
    }

    /**
     * Remove gamesOuter
     *
     * @param \ZIMZIM\Bundles\AppBundle\Entity\Game $gamesOuter
     */
    public function removeGamesOuter(\ZIMZIM\Bundles\AppBundle\Entity\Game $gamesOuter)
    {
        $this->gamesOuter->removeElement($gamesOuter);
    }

    /**
     * Get gamesOuter
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGamesOuter()
    {
        return $this->gamesOuter;
    }
}
