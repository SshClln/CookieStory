<?php

namespace CookieStory\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Recette
 *
 * @ORM\Table(name="recette")
 * @ORM\Entity(repositoryClass="CookieStory\BlogBundle\Repository\RecetteRepository")
 */
class Recette
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
   * @Gedmo\Slug(fields={"titre"})
   * @ORM\Column(length=128, unique=true)
   */
   private $slug;

    /**
     * @ORM\OneToMany(targetEntity="CookieStory\BlogBundle\Entity\Layout", mappedBy="recette")
     */
    private $layouts;

    /**
     * @ORM\OneToMany(targetEntity="CookieStory\BlogBundle\Entity\Commentaires", mappedBy="recette")
     */
    private $commentaires;

    /**
     * @ORM\ManyToMany(targetEntity="CookieStory\BlogBundle\Entity\Tags", mappedBy="recettes")
     */
    private $tags;


    public function __construct()
    {
      $this->layouts= new ArrayCollection();
      $this->tags= new ArrayCollection();
    }
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Recette
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Add layout
     *
     * @param \CookieStory\BlogBundle\Entity\Layout $layout
     *
     * @return Recette
     */
    public function addLayout(\CookieStory\BlogBundle\Entity\Layout $layout)
    {
        $this->layouts[] = $layout;

        $layout->setRecette($this);

        return $this;
    }

    /**
     * Remove layout
     *
     * @param \CookieStory\BlogBundle\Entity\Layout $layout
     */
    public function removeLayout(\CookieStory\BlogBundle\Entity\Layout $layout)
    {
        $this->layouts->removeElement($layout);
    }

    /**
     * Get layouts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLayouts()
    {
        return $this->layouts;
    }

    /**
     * Add commentaire
     *
     * @param \CookieStory\BlogBundle\Entity\commentaires $commentaire
     *
     * @return Recette
     */
    public function addCommentaire(\CookieStory\BlogBundle\Entity\Commentaires $commentaire)
    {
        $this->commentaires[] = $commentaire;

        $commentaire->setRecette($this);

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \CookieStory\BlogBundle\Entity\Commentaires $commentaire
     */
    public function removeCommentaire(\CookieStory\BlogBundle\Entity\Commentaires $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
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
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add tag
     *
     * @param \CookieStory\BlogBundle\Entity\tags $tags
     *
     * @return Recette
     */
    public function addTag(\CookieStory\BlogBundle\Entity\Tags $tag)
    {
        $this->tags[] = $tag;
        
        return $this;
    }

    /**
     * Remove tag
     *
     * @param \CookieStory\BlogBundle\Entity\Tags $tag
     */
    public function removeTag(\CookieStory\BlogBundle\Entity\Tags $tag)
    {
        $this->tags->removeElement($tag);
    }

}
