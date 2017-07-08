<?php

namespace CookieStory\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


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
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
   * @Gedmo\Slug(fields={"nom"})
   * @ORM\Column(length=128, unique=true)
   */
   private $slug;

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
     * Set slug
     *
     * @param string $slug
     *
     * @return Recette
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Set image
     *
     * @param string $image
     *
     * @return Tags
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
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
