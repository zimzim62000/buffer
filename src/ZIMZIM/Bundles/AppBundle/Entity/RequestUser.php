<?php

namespace ZIMZIM\Bundles\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RequestUser
 *
 * @ORM\Table("parierentreamis_request_user")
 * @ORM\Entity(repositoryClass="ZIMZIM\Bundles\AppBundle\Entity\Repository\RequestUserRepository")
 * @UniqueEntity(fields={"email", "userTournament"}, groups={"email"},
 * message="validate.entity.app.requestuser.uniqueentity")
 */
class RequestUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(visible=false, sortable=false, filterable=false, title="id")
     */
    private $id;

    /**
     * @var integer
     *
     * @GRID\Column(field="user.username", title="entity.app.requestuser.user", operatorsVisible=false, source=true, filter="select")
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\UserBundle\Entity\User", inversedBy="requestsUser")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", nullable=true)
     */
    private $user;

    /**
     * @var integer
     * @Assert\NotBlank()
     * @GRID\Column(field="userTournament.name", title="entity.app.requestuser.usertournament", operatorsVisible=false, source=true, filter="select")
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\UserTournament", inversedBy="requestsUser")
     * @ORM\JoinColumn(name="id_user_tournament", referencedColumnName="id", nullable=false)
     */
    private $userTournament;

    /**
     * @var string
     * @GRID\Column(title="entity.app.requestuser.email",operatorsVisible=false, visible=true)
     *
     * @Assert\Email(groups={"email"}, message="testetetettetetet")
     * @Assert\NotBlank(groups={"email"})
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;


    /**
     * @var string
     * @GRID\Column(title="entity.app.requestuser.text",operatorsVisible=false, visible=false, filterable=false)
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

    /**
     * @var \DateTime
     * @GRID\Column(operatorsVisible=false, visible=false)
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @GRID\Column(title="entity.app.requestuser.enabled",operatorsVisible=false, visible=true)
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var integer
     * @GRID\Column(title="entity.app.requestuser.enabled",operatorsVisible=false, visible=true)
     * @Assert\NotBlank()
     * @ORM\Column(name="enabled", type="integer")
     */
    private $enabled = 0;

    /**
     * @var integer
     * @GRID\Column(title="entity.app.requestuser.validate",operatorsVisible=false, visible=true)
     *
     * @ORM\Column(name="validate", type="integer", nullable=true)
     */
    private $validate;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\RequestUserBet", mappedBy="requestUser")
     */
    private $requestsUserBet;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\Score", mappedBy="requestUser")
     */
    private $scores;


    /**
     * @var \ZIMZIM\Bundles\AppBundle\Entity\RequestUserRanking
     *
     * @ORM\OneToOne(targetEntity="ZIMZIM\Bundles\AppBundle\Entity\RequestUserRanking", mappedBy="requestUser")
     */
    private $requestUserRanking;

    public function __construct()
    {

        $this->requestsUserBet = new ArrayCollection();
        $this->scores = new ArrayCollection();
    }

    public function __toString()
    {
        if ($this->user instanceof \ZIMZIM\Bundles\UserBundle\Entity\User) {
            return $this->user->getUsername() . ' ' . $this->userTournament->getName();
        }

        return $this->email . ' ' . $this->userTournament->getName();
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
     * @return RequestUser
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
     * Set email
     *
     * @param string $email
     * @return RequestUser
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return RequestUser
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
     * @return RequestUser
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
     * @param integer $enabled
     * @return RequestUser
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param int $userTournament
     */
    public function setUserTournament($userTournament)
    {
        $this->userTournament = $userTournament;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserTournament()
    {
        return $this->userTournament;
    }

    /**
     * @param int $validate
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;

        return $this;
    }

    /**
     * @return int
     */
    public function getValidate()
    {
        return $this->validate;
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
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param \ZIMZIM\Bundles\AppBundle\Entity\RequestUserRanking $requestUserRanking
     */
    public function setRequestUserRanking($requestUserRanking)
    {
        $this->requestUserRanking = $requestUserRanking;

        return $this;
    }

    /**
     * @return \ZIMZIM\Bundles\AppBundle\Entity\RequestUserRanking
     */
    public function getRequestUserRanking()
    {
        return $this->requestUserRanking;
    }

}
