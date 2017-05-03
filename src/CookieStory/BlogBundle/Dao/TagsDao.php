<?php

namespace CookieStory\BlogBundle\Dao;

use CookieStory\BlogBundle\Entity\Tags;
use CookieStory\BlogBundle\Repository\TagsRepository;
use Doctrine\ORM\EntityManager;

class TagsDao
{
  //@var EntityManager
  private $em;

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }

  public function get($id)
  {
    $tagsRepository = $this->em->getRepository('CookieStoryBlogBundle:Tags');
    $tags = $tagsRepository->find($id);
    return $tags;
  }

  public function getAll($recetteId)
  {
    $tagsRepository = $this->em->getRepository('CookieStoryBlogBundle:Tags');
    $tags = $tagsRepository->findByRecette($recetteId);
    return $tags;
  }

  public function liste()
  {
    $tagRepository = $this->em->getRepository('CookieStoryBlogBundle:Tags');
    $tags = $tagRepository->findAll();
    return $tags;
  }

}
