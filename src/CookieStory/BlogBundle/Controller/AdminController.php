<?php

namespace CookieStory\BlogBundle\Controller;

use CookieStory\BlogBundle\Dao\AdminDao;
use CookieStory\BlogBundle\Entity\Admin;

use Doctrine\ORM\EntityManager;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdminController extends Controller
{
    //@var AdminDao
    private $adminDao;

    //@var EntityManager
    private $em;

    public function __construct(AdminDao $adminDao, EntityManager $em)
    {
      $this->adminDao = $adminDao;
      $this->em = $em;
    }

    public function connexion(Request $request)
    {
      try {
        $jsonAdmin = json_decode($request->getContent(), true)['admin'];
        $identifiant = $jsonAdmin['identifiant'];
        $mdpReq = $jsonAdmin['password'];
        $adminBase = $this->adminDao->getOneByIdentifiant($identifiant);
        if($adminBase->getPassword() == $mdpReq){
          session_start();
          $_SESSION['identifiant'] = $identifiant;
          return new JsonResponse($this->userToJson($adminBase));
        }
        else{
          return new JsonResponse(["status" => "ko"]);
        }
      } catch (Exception $e) {
        return new JsonResponse(["error" => $e->getMessage()]);
      }
    }

    public function userToJson($user) {
      $json = [];
      $json['id'] = $user->getId();
      $json['identifiant'] = $user->getIdentifiant();

      return $json;
    }

    public function getAdmin(Request $request)
    {
        $identifiant = $request->query->get('identifiant');

        $admin = $this->adminDao->getOneByIdentifiant($identifiant);

        return new JsonResponse($admin);
    }
}
