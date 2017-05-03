<?php

namespace CookieStory\BlogBundle\Dao;

use CookieStory\BlogBundle\Entity\Layout;
use CookieStory\BlogBundle\Repository\LayoutRepository;
use Doctrine\ORM\EntityManager;

class LayoutDao
{
  //@var EntityManager
  private $em;

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }

  public function get($id)
  {
    $layoutRepository = $this->em->getRepository('CookieStoryBlogBundle:Layout');
    $layout = $layoutRepository->find($id);
    return $layout;
  }

  public function getAll($recetteId)
  {
    $layoutRepository = $this->em->getRepository('CookieStoryBlogBundle:Layout');
    $layouts = $layoutRepository->findByRecette($recetteId);
    return $layouts;
  }

}
