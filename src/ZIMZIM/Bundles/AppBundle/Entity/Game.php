<?php

namespace ZIMZIM\Bundles\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Game
 *
 * @ORM\Table(name="parierentreamis_game")
 * @ORM\Entity(repositoryClass="ZIMZIM\Bundles\AppBundle\Entity\Repository\GameRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Game
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(visible=false, sortable=false, filterable=false, title="entity.app.game.id", groups={"admin"})
     * @GRID\Column(operatorsVisible=false, visible=false, sortable=false, filterable=false, groups={"user"})
     */
    private $id;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     *
     * @GRID\Column(field="tournament.name", title="entity.app.game.tournament",operatorsVisible=false,
     * source=true, filter="select", groups={"admin"})
     *
     * @GRID\Column(operatorsVisible=false, visible=false, sortable=false, filterable=false, groups={"user"})
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\Tournament", inversedBy="games")
     * @ORM\JoinColumn(name="id_tournament", referencedColumnName="id", nullable=false)
     */
    private $tournament;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     *
     * @GRID\Column(field="teamHome.name", title="entity.app.game.teamhome",operatorsVisible=false,
     * source=true, filter="select", groups={"admin"})
     *
     * @GRID\Column(field="teamHome.name", filterable=false, sortable=false, title="entity.app.game.teamhome",operatorsVisible=false,
     * source=true, filter="select", groups={"user"})
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\Team", inversedBy="gamesHome")
     * @ORM\JoinColumn(name="id_team_home", referencedColumnName="id", nullable=false)
     */
    private $teamHome;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     *
     * @GRID\Column(field="teamOuter.name", title="entity.app.game.teamouter", operatorsVisible=false,
     * source=true, filter="select", groups={"admin"})
     *
     * @GRID\Column(field="teamOuter.name", filterable=false, sortable=false, title="entity.app.game.teamouter", operatorsVisible=false,
     * source=true, filter="select", groups={"user"})
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\Team", inversedBy="gamesOuter")
     * @ORM\JoinColumn(name="id_team_outer", referencedColumnName="id", nullable=false)
     */
    private $teamOuter;

    /**
     * @var integer
     *
     * @Assert\NotBlank(groups={"score"})
     *
     * @GRID\Column(operatorsVisible=false, filterable=false,
     * title="entity.app.game.scorehome", groups={"admin"})
     * @GRID\Column(operatorsVisible=false, visible=false, sortable=false, filterable=false, groups={"user"})
     *
     * @ORM\Column(name="score_team_home", type="integer", nullable=true)
     */
    private $scoreTeamHome;

    /**
     * @var integer
     *
     * @Assert\NotBlank(groups={"score"})
     *
     * @GRID\Column(operatorsVisible=false, filterable=false,
     * title="entity.app.game.scoreouter", groups={"admin"})
     * @GRID\Column(operatorsVisible=false, visible=false, sortable=false, filterable=false, groups={"user"})
     *
     * @ORM\Column(name="score_team_outer", type="integer", nullable=true)
     */
    private $scoreTeamOuter;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     *
     * @GRID\Column(format="d/m - H:i", operatorsVisible=false, title="entity.app.game.date"
     * , groups={"admin"})
     * @GRID\Column(format="d/m - H:i", operatorsVisible=false, title="entity.app.game.date"
     * , groups={"user"})
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     *
     * @GRID\Column(operatorsVisible=false, field="tournamentDay.name", filterable=true,
     * title="entity.app.game.dayGame", source=true, filter="select", groups={"admin"})
     *
     * @GRID\Column(field="tournamentDay.name", title="entity.app.game.dayGame",operatorsVisible=false,
     * source=true, filter="select", groups={"user"}, visible=false)
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\TournamentDay")
     * @ORM\JoinColumn(name="id_tournament_day", referencedColumnName="id", nullable=false)
     */
    private $tournamentDay;

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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\RequestUserBet", mappedBy="game")
     */
    private $requestsUserBet;

    /**
     * @var string score
     *
     * @GRID\Column(operatorsVisible=false, title="entity.app.game.score", filterable=false
     * , groups={"user"})
     *
     * @ORM\Column(name="score", type="string", length=255, nullable=true)
     */
    private $score;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\Score", mappedBy="game")
     */
    private $scores;


    public function __construct()
    {

        $this->requestsUserBet = new ArrayCollection();
        $this->scores = new ArrayCollection();

    }


    public function __toString()
    {
        return $this->getTournamentDay() . ' : ' . $this->getTeamHome() . ' - ' . $this->getTeamOuter();
    }

    /** @ORM\PreUpdate */
    public function updateScore(){
        $this->score = $this->scoreTeamHome.' - '.$this->scoreTeamOuter;
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
     * Set scoreTeamHome
     *
     * @param integer $scoreTeamHome
     * @return Game
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
     * @return Game
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
     * Set date
     *
     * @param \DateTime $date
     * @return Game
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Game
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
     * @return Game
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
     * Set tournament
     *
     * @param \ZIMZIM\Bundles\AppBundle\Entity\Tournament $tournament
     * @return Game
     */
    public function setTournament(\ZIMZIM\Bundles\AppBundle\Entity\Tournament $tournament)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return \ZIMZIM\Bundles\AppBundle\Entity\Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * Set teamHome
     *
     * @param \ZIMZIM\Bundles\AppBundle\Entity\Team $teamHome
     * @return Game
     */
    public function setTeamHome(\ZIMZIM\Bundles\AppBundle\Entity\Team $teamHome)
    {
        $this->teamHome = $teamHome;

        return $this;
    }

    /**
     * Get teamHome
     *
     * @return \ZIMZIM\Bundles\AppBundle\Entity\Team
     */
    public function getTeamHome()
    {
        return $this->teamHome;
    }

    /**
     * Set teamOuter
     *
     * @param \ZIMZIM\Bundles\AppBundle\Entity\Team $teamOuter
     * @return Game
     */
    public function setTeamOuter(\ZIMZIM\Bundles\AppBundle\Entity\Team $teamOuter)
    {
        $this->teamOuter = $teamOuter;

        return $this;
    }

    /**
     * Get teamOuter
     *
     * @return \ZIMZIM\Bundles\AppBundle\Entity\Team
     */
    public function getTeamOuter()
    {
        return $this->teamOuter;
    }

    /**
     * Set tournamentDay
     *
     * @param \ZIMZIM\Bundles\AppBundle\Entity\TournamentDay $tournamentDay
     * @return Game
     */
    public function setTournamentDay(\ZIMZIM\Bundles\AppBundle\Entity\TournamentDay $tournamentDay)
    {
        $this->tournamentDay = $tournamentDay;

        return $this;
    }

    /**
     * Get tournamentDay
     *
     * @return \ZIMZIM\Bundles\AppBundle\Entity\TournamentDay
     */
    public function getTournamentDay()
    {
        return $this->tournamentDay;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $requestsUserBet
     */
    public function setRequestsUserBet($requestsUserBet)
    {
        $this->requestsUserBet = $requestsUserBet;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRequestsUserBet()
    {
        return $this->requestsUserBet;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $scores
     */
    public function setScores($scores)
    {
        $this->scores = $scores;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

}
