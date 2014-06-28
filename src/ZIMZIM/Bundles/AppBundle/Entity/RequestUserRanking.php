<?php

namespace ZIMZIM\Bundles\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * RequestUserRanking
 *
 * @ORM\Table(name="parierentreamis_request_user_ranking")
 * @ORM\Entity(repositoryClass="ZIMZIM\Bundles\AppBundle\Entity\Repository\RequestUserRankingRepository")
 */
class RequestUserRanking
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
     * @var \ZIMZIM\Bundles\AppBundle\Entity\RequestUser
     *
     * @Assert\NotBlank()
     *
     *
     * @ORM\OneToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\RequestUser", inversedBy="requestUserRanking")
     * @ORM\JoinColumn(name="id_tournament_day", referencedColumnName="id", nullable=false)
     */
    private $requestUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_max_score", type="integer")
     */
    private $nbMaxScore;

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
     * Set requestUser
     *
     * @param integer $requestUser
     * @return RequestUserRanking
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
     * Set score
     *
     * @param integer $score
     * @return RequestUserRanking
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set nbMaxScore
     *
     * @param integer $nbMaxScore
     * @return RequestUserRanking
     */
    public function setNbMaxScore($nbMaxScore)
    {
        $this->nbMaxScore = $nbMaxScore;

        return $this;
    }

    /**
     * Get nbMaxScore
     *
     * @return integer 
     */
    public function getNbMaxScore()
    {
        return $this->nbMaxScore;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return RequestUserRanking
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
     * Set updated�At
     *
     * @param \DateTime $updated�At
     * @return RequestUserRanking
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updated�At
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
