<?php

namespace ZIMZIM\Bundles\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Score
 *
 * @ORM\Table(name="parierentreamis_score")
 * @ORM\Entity(repositoryClass="ZIMZIM\Bundles\AppBundle\Entity\Repository\ScoreRepository")
 */
class Score
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(visible=false, sortable=false, filterable=false, title="entity.app.score.id", groups={"admin"})
     */
    private $id;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     *
     * @GRID\Column(field="game.teamHome.name", title="entity.app.score.game",operatorsVisible=false,
     * source=true, filter="select", groups={"admin"})
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\Game", inversedBy="scores")
     * @ORM\JoinColumn(name="id_game", referencedColumnName="id", nullable=false)
     */
    private $game;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     *
     * @GRID\Column(field="requestUser.user.username", title="entity.app.score.requestuser",operatorsVisible=false,
     * source=true, filter="select", groups={"admin"})
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\RequestUser", inversedBy="scores")
     * @ORM\JoinColumn(name="id_request_user", referencedColumnName="id", nullable=false)
     */
    private $requestUser;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     *
     * @GRID\Column(field="requestUserBet.game.teamHome.name", title="entity.app.score.requestuserbet",operatorsVisible=false,
     * source=true, filter="select", groups={"admin"})
     *
     * @ORM\OneToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\RequestUserBet", inversedBy="score")
     * @ORM\JoinColumn(name="id_request_user_bet", referencedColumnName="id", nullable=true)
     */
    private $requestUserBet;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false, groups={"admin"})
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false, groups={"admin"})
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var integer
     *
     * @GRID\Column(field="score", title="entity.app.score.score",operatorsVisible=false,
     * groups={"admin"})
     *
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

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
     * Set game
     *
     * @param integer $game
     * @return Score
     */
    public function setGame($game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return integer 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set requestUser
     *
     * @param integer $requestUser
     * @return Score
     */
    public function setRequestUser($requestUser)
    {
        $this->requestUser = $requestUser;

        return $this;
    }

    /**
     * Get requestUser
     *
     * @return integer 
     */
    public function getRequestUser()
    {
        return $this->requestUser;
    }

    /**
     * Set requestUserBet
     *
     * @param integer $requestUserBet
     * @return Score
     */
    public function setRequestUserBet($requestUserBet)
    {
        $this->requestUserBet = $requestUserBet;

        return $this;
    }

    /**
     * Get requestUserBet
     *
     * @return integer 
     */
    public function getRequestUserBet()
    {
        return $this->requestUserBet;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Score
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
     * @return Score
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
     * @param int $score
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }


}
