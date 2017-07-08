<?php

namespace CookieStory\BlogBundle\Dao;

use CookieStory\BlogBundle\Entity\Admin;
use CookieStory\BlogBundle\Repository\AdminRepository;
use Doctrine\ORM\EntityManager;

class AdminDao
{
  //@var EntityManager
  private $em;

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }


  public function getById($id)
  {
    $adminRepository = $this->em->getRepository('CookieStoryBlogBundle:Admin');
    $admin = $adminRepository->find($id);
    return $admin;
  }

  public function getOneByIdentifiant($identifiant)
  {
    $adminRepository = $this->em->getRepository('CookieStoryBlogBundle:Admin');

    $admin = $adminRepository->findOneByIdentifiant($identifiant);

    return $admin;
  }


  public function liste()
  {
    $adminRepository = $this->em->getRepository('CookieStoryBlogBundle:Admin');
    $admins = $adminRepository->findAll();
    return $admins;
  }
}
