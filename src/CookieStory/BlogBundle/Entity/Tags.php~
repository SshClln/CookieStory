<?php

namespace CookieStory\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tags
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity(repositoryClass="CookieStory\BlogBundle\Repository\TagsRepository")
 */
class Tags
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
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="CookieStory\BlogBundle\Entity\Recette", inversedBy="tags")
     * @ORM\JoinTable (name="recettes_tags")
     */
    private $recettes;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Tags
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set recettes
     *
     * @param \CookieStory\BlogBundle\Entity\Recette $recettes
     *
     * @return Tags
     */
    public function setRecettes(\CookieStory\BlogBundle\Entity\Recette $recettes)
    {
        $this->recettes = $recettes;

        return $this;
    }

    /**
     * Get recettes
     *
     * @return \CookieStory\BlogBundle\Entity\Recette
     */
    public function getRecettes()
    {
        return $this->recettes;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recettes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add recette
     *
     * @param \CookieStory\BlogBundle\Entity\Recette $recette
     *
     * @return Tags
     */
    public function addRecette(\CookieStory\BlogBundle\Entity\Recette $recette)
    {
        $this->recettes[] = $recette;

        return $this;
    }

    /**
     * Remove recette
     *
     * @param \CookieStory\BlogBundle\Entity\Recette $recette
     */
    public function removeRecette(\CookieStory\BlogBundle\Entity\Recette $recette)
    {
        $this->recettes->removeElement($recette);
    }
}
