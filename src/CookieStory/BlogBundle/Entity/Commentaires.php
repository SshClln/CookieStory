<?php

namespace CookieStory\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaires
 *
 * @ORM\Table(name="commentaires")
 * @ORM\Entity(repositoryClass="CookieStory\BlogBundle\Repository\CommentairesRepository")
 */
class Commentaires
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=255, nullable=false)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255)
     */
    private $website;

    // /**
    //  * @var date
    //  *
    //  * @ORM\Column(name="date", type="date")
    //  */
    // private $date_post;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=false)
     */
    private $commentaire;


    /**
     * @ORM\ManyToOne(targetEntity="CookieStory\BlogBundle\Entity\Recette", inversedBy="id")
     * @ORM\JoinColumn (name="recette_id", referencedColumnName="id", nullable=false)
     */
    private $recette;

    // public function __construct()
    // {
    //   $this->date_post = new DateTime();
    // }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Commentaires
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Commentaires
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Commentaires
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set date
     *
     * @param date $date_post
     *
     * @return Commentaires
     */
    public function setDatePost($date_post)
    {
        $this->date_post = $date_post;

        return $this;
    }

    /**
     * Get date
     *
     * @return date
     */
    public function getDatePost()
    {
        return $this->date_post;
    }

    /**
     * Set commentaire
     *
     * @param text $commentaire
     *
     * @return Commentaires
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return text
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }


    /**
     * Set recette
     *
     * @param \CookieStory\BlogBundle\Entity\Recette $recette
     *
     * @return Commentaires
     */
    public function setRecette(\CookieStory\BlogBundle\Entity\Recette $recette)
    {
        $this->recette = $recette;

        return $this;
    }

    /**
     * Get recette
     *
     * @return \CookieStory\BlogBundle\Entity\Recette
     */
    public function getRecette()
    {
        return $this->recette;
    }
}
