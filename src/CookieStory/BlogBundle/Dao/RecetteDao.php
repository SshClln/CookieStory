<?php

namespace CookieStory\BlogBundle\Dao;

use CookieStory\BlogBundle\Entity\Recette;
use CookieStory\BlogBundle\Repository\RecetteRepository;
use Doctrine\ORM\EntityManager;

class RecetteDao
{
  //@var EntityManager
  private $em;

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }


  public function get($id)
  {
    $recetteRepository = $this->em->getRepository('CookieStoryBlogBundle:Recette');
    $recette = $recetteRepository->find($id);
    return $recette;
  }

  public function getOneBySlug($slug)
  {
    $recetteRepository = $this->em->getRepository('CookieStoryBlogBundle:Recette');
    $recette = $recetteRepository->findOneBySlug($slug);
    return $recette;
  }

  public function liste()
  {
    $recetteRepository = $this->em->getRepository('CookieStoryBlogBundle:Recette');
    $recettes = $recetteRepository->findAll();
    return $recettes;
  }
}
