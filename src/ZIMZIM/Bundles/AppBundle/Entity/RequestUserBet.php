<?php

namespace ZIMZIM\Bundles\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RequestUserBet
 *
 * @ORM\Table(name="parierentreamis_request_user_bet")
 * @ORM\Entity(repositoryClass="ZIMZIM\Bundles\AppBundle\Entity\Repository\RequestUserBetRepository")
 * @UniqueEntity(fields={"requestUser", "game"},
 * message="validate.entity.app.requestuserbet.uniqueentity")
 */
class RequestUserBet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(visible=false, sortable=false, filterable=false, title="entity.app.game.id", groups={"admin"})
     */
    private $id;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     *
     * @GRID\Column(field="game.name", title="entity.app.requestuserbet.game",operatorsVisible=false,
     * source=true, filter="select", groups={"admin"})
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\Game", inversedBy="requestsUserBet")
     * @ORM\JoinColumn(name="id_game", referencedColumnName="id", nullable=false)
     */
    private $game;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     *
     * @GRID\Column(field="requestUser.user.username", title="entity.app.requestuserbet.requestuser",operatorsVisible=false,
     * source=true, filter="select", groups={"admin"})
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\RequestUser", inversedBy="requestsUserBet")
     * @ORM\JoinColumn(name="id_request_user", referencedColumnName="id", nullable=false)
     */
    private $requestUser;

    /**
     * @var integer
     *
     * @Assert\NotBlank(groups={"score"})
     *
     * @ORM\Column(name="scoreTeamHome", type="integer")
     */
    private $scoreTeamHome;

    /**
     * @var integer
     *
     * @Assert\NotBlank(groups={"score"})
     *
     * @ORM\Column(name="scoreTeamOuter", type="integer")
     */
    private $scoreTeamOuter;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


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
     * Set scoreTeamHome
     *
     * @param integer $scoreTeamHome
     * @return RequestUserBet
     */
    public function setScoreTeamHome($scoreTeamHome)
    {
        $this->scoreTeamHome = $scoreTeamHome;

        return $this;
    }

    /**
     * Get scoreTeamHome
     *
     * @return integer 
     */
    public function getScoreTeamHome()
    {
        return $this->scoreTeamHome;
    }

    /**
     * Set scoreTeamOuter
     *
     * @param integer $scoreTeamOuter
     * @return RequestUserBet
     */
    public function setScoreTeamOuter($scoreTeamOuter)
    {
        $this->scoreTeamOuter = $scoreTeamOuter;

        return $this;
    }

    /**
     * Get scoreTeamOuter
     *
     * @return integer 
     */
    public function getScoreTeamOuter()
    {
        return $this->scoreTeamOuter;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return RequestUserBet
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
     * @return RequestUserBet
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
     * Set game
     *
     * @param \ZIMZIM\Bundles\AppBundle\Entity\Game $game
     * @return RequestUserBet
     */
    public function setGame(\ZIMZIM\Bundles\AppBundle\Entity\Game $game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \ZIMZIM\Bundles\AppBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set requestUser
     *
     * @param \ZIMZIM\Bundles\AppBundle\Entity\RequestUser $requestUser
     * @return RequestUserBet
     */
    public function setRequestUser(\ZIMZIM\Bundles\AppBundle\Entity\RequestUser $requestUser)
    {
        $this->requestUser = $requestUser;

        return $this;
    }

    /**
     * Get requestUser
     *
     * @return \ZIMZIM\Bundles\AppBundle\Entity\Game 
     */
    public function getRequestUser()
    {
        return $this->requestUser;
    }
}
