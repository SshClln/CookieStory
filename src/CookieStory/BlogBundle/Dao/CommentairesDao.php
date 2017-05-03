<?php

namespace CookieStory\BlogBundle\Dao;

use CookieStory\BlogBundle\Entity\Commentaires;
use CookieStory\BlogBundle\Repository\CommentairesRepository;
use Doctrine\ORM\EntityManager;

class CommentairesDao
{
  //@var EntityManager
  private $em;

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }

  public function get($id)
  {
    $commentairesRepository = $this->em->getRepository('CookieStoryBlogBundle:Commentaires');
    $commentaires = $commentairesRepository->find($id);
    return $commentaires;
  }

  public function getAll($recetteId)
  {
    $commentairesRepository = $this->em->getRepository('CookieStoryBlogBundle:Commentaires');
    $commentaires = $commentairesRepository->findByRecette($recetteId);
    return $commentaires;
  }

}
