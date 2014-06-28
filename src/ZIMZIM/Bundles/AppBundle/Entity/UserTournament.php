<?php

namespace ZIMZIM\Bundles\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * UserTournament
 *
 * @ORM\Table(name="parierentreamis_user_tournament")
 * @ORM\Entity(repositoryClass="ZIMZIM\Bundles\AppBundle\Entity\Repository\UserTournamentRepository")
 * @UniqueEntity("name")
 */
class UserTournament
{
    /**
     * @var integer
     *
     * @GRID\Column(visible=false, sortable=false, filterable=false, title="entity.app.tournament.id")
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @GRID\Column(field="user.username", title="entity.app.usertournament.user", operatorsVisible=false, source=true, filter="select")
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\UserBundle\Entity\User", inversedBy="userTournaments")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @var integer
     *
     * @GRID\Column(field="tournament.name", title="entity.app.usertournament.tournament", operatorsVisible=false, source=true, filter="select")
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\Tournament", inversedBy="userTournaments")
     * @ORM\JoinColumn(name="id_tournament", referencedColumnName="id", nullable=false)
     */
    private $tournament;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @GRID\Column(title="entity.app.usertournament.name",operatorsVisible=false)
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @var string
     * @GRID\Column(title="entity.app.usertournament.text",operatorsVisible=false, visible=false, filterable=false)
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

    /**
     * @Assert\NotBlank()
     * @var string
     * @GRID\Column(title="entity.app.usertournament.bet",operatorsVisible=false, visible=false, filterable=false)
     *
     * @ORM\Column(name="bet", type="text", nullable=true)
     */
    private $bet;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     * @GRID\Column(title="entity.app.usertournament.datestart",operatorsVisible=false, visible=true)
     *
     * @ORM\Column(name="date_start", type="datetime")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     * @GRID\Column(title="entity.app.usertournament.dateend",operatorsVisible=false, visible=true)
     *
     * @ORM\Column(name="date_end", type="datetime")
     */
    private $dateEnd;

    /**
     * @var boolean
     *
     * @Assert\NotBlank()
     * @GRID\Column(title="entity.app.usertournament.enabled",operatorsVisible=false, visible=true)
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

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
     * @ORM\OneToMany(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\RequestUser", mappedBy="userTournament", cascade={"persist"})
     */
    private $requestsUser;


    public function __construct(){

        $this->requestsUser = new ArrayCollection();
    }

    public function  __toString(){
        return $this->name;
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
     * Set user
     *
     * @param integer $user
     * @return UserTournament
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return UserTournament
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
     * Set text
     *
     * @param string $text
     * @return UserTournament
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return UserTournament
     */
    public function setBet($bet)
    {
        $this->bet = $bet;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getBet()
    {
        return $this->bet;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return UserTournament
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return UserTournament
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set tournament
     *
     * @param integer $tournament
     * @return UserTournament
     */
    public function setTournament($tournament)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return integer 
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return UserTournament
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
     * @return UserTournament
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return UserTournament
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $requestsUser
     */
    public function setRequestsUser($requestsUser)
    {
        $this->requestsUser = $requestsUser;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRequestsUser()
    {
        return $this->requestsUser;
    }


}
