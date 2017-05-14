<?php

namespace CookieStory\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CookieStoryBlogBundle:Default:index.html.php');
    }

  public function uploadAction() {
    if(isset($_FILES['file'])){
       $filename = basename( $_FILES["file"]["name"]);
       $target_path = dirname(__DIR__, 4) . DIRECTORY_SEPARATOR ."web" . DIRECTORY_SEPARATOR ."public" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR;
       $destination = $target_path . $filename;
       $result = move_uploaded_file($_FILES['file']['tmp_name'] , $destination);
        return new JsonResponse(['success'=>$result, 'path' => $target_path]);
        return new JsonResponse(['success'=>$result, 'path' => 'public/images/' . $filename]);
    }
    return new JsonResponse(['status'=>'ko']);
  }
}
