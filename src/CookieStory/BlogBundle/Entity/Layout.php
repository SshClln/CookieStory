<?php

namespace CookieStory\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Layout
 *
 * @ORM\Table(name="layout")
 * @ORM\Entity(repositoryClass="CookieStory\BlogBundle\Repository\LayoutRepository")
 */
class Layout
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
     * @ORM\ManyToOne(targetEntity="CookieStory\BlogBundle\Entity\Recette", inversedBy="layouts")
     * @ORM\JoinColumn (name="recette_id", referencedColumnName="id", nullable=false)
     */
    private $recette;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=255)
     */
    private $item;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;


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
     * Set item
     *
     * @param string $item
     *
     * @return Layout
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Layout
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Layout
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set recette
     *
     * @param \CookieStory\BlogBundle\Entity\Recette $recette
     *
     * @return Layout
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
