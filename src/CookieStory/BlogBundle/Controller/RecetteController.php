<?php

namespace CookieStory\BlogBundle\Controller;

use CookieStory\BlogBundle\Dao\RecetteDao;
use CookieStory\BlogBundle\Dao\LayoutDao;
use CookieStory\BlogBundle\Dao\CommentairesDao;
use CookieStory\BlogBundle\Dao\TagsDao;
use CookieStory\BlogBundle\Entity\Recette;
use CookieStory\BlogBundle\Entity\Layout;
use CookieStory\BlogBundle\Entity\Commentaires;
use CookieStory\BlogBundle\Entity\Tags;
use Doctrine\ORM\EntityManager;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RecetteController extends Controller
{
    //@var RecetteDao
    private $recetteDao;

    //@var TagsDao
    private $tagsDao;

    //@var LayoutDao
    private $layoutDao;

    //@var EntityManager
    private $em;

    //@var CommentairesDao
    private $commentairesDao;

    public function __construct(RecetteDao $recetteDao, LayoutDao $layoutDao, EntityManager $em, TagsDao $tagsDao
        // , CommentairesDao $commentairesDao
    )
    {
        $this->recetteDao = $recetteDao;
        $this->layoutDao = $layoutDao;
        $this->tagsDao = $tagsDao;
        $this->em = $em;
        // $this->commentairesDao = $commentairesDao;
    }


    public function getRecette(Request $request)
    {
        $slug = $request->query->get('slug');

        $recette = $this->recetteDao->getOneBySlug($slug);

        return new JsonResponse($this->RecetteToJson($recette));
    }

    public function getTag(Request $request)
    {
        $slug = $request->query->get('slug');

        $tag = $this->tagsDao->getOneBySlug($slug);

        return new JsonResponse($tag);
    }

    public function getListeRecette(Request $request)
    {
        try {
            $recettes = $this->recetteDao->liste();
            $listeJson = [];

            foreach ($recettes as $recette) {
                $listeJson[] = $this->RecetteToJson($recette);
            }

            return new JsonResponse($listeJson);
        } catch (\Exception $ex) {
            PRINT $ex->getMessage();
        }

    }

    public function getListeRecetteByTag(Request $request)
    {
        try {
            $slug = $request->query->get('slug');

            $tag = $this->tagsDao->getOneBySlug($slug);

            $recettes = $tag->getRecettes();
            $listeJson = [];

            foreach ($recettes as $recette) {
                $listeJson[] = $this->RecetteToJson($recette);
            }

            return new JsonResponse($listeJson);
        } catch (\Exception $ex) {
            PRINT $ex->getMessage();
        }

    }

    public function getListeTags(Request $request)
    {
        try {
            $tags = $this->tagsDao->liste();
            $listeJson = [];

            foreach ($tags as $tag) {
                $json = [];
                $json['id'] = $tag->getId();
                $json['nom'] = $tag->getNom();
                $json['image'] = $tag->getImage();
                $json['slug'] = $tag->getSlug();
                $listeJson[] = $json;
            }

            return new JsonResponse($listeJson);
        } catch (\Exception $ex) {
            PRINT $ex->getMessage();
        }

    }

    public function RecetteToJson($recette)
    {
        $json = [];
        $json['id'] = $recette->getId();
        $json['titre'] = $recette->getTitre();
        $json['slug'] = $recette->getSlug();
        $json['layout'] = [];
        $json['commentaires'] = [];
        $json['tags'] = [];

        $layouts = $recette->getLayouts();

        foreach ($layouts as $layout) {
            $layoutJson = [];
            $layoutJson['id'] = $layout->getId();
            $layoutJson['item'] = $layout->getItem();
            $layoutJson['position'] = $layout->getPosition();
            $layoutJson['contenu'] = json_decode($layout->getContenu());
            $json['layout'][] = $layoutJson;
        }

        $commentaires = $recette->getCommentaires();

        foreach ($commentaires as $commentaire) {
            $commentaireJson = [];
            $commentaireJson['id'] = $commentaire->getId();
            $commentaireJson['pseudo'] = $commentaire->getPseudo();
            $commentaireJson['mail'] = $commentaire->getMail();
            $commentaireJson['website'] = $commentaire->getWebsite();
            if ($commentaire->getDatePost()) {
                $commentaireJson['datePost'] = $commentaire->getDatePost()->format('d/m/Y H:i');
            }
            $commentaireJson['commentaire'] = $commentaire->getCommentaire();
            $json['commentaires'][] = $commentaireJson;
        }

        $tags = $recette->getTags();

        foreach ($tags as $tag) {
            $tagJson = [];
            $tagJson['id'] = $tag->getId();
            $tagJson['nom'] = $tag->getNom();
            $json['tags'][] = $tagJson;
        }

        return $json;
    }

    public function saveRecette(Request $request)
    {
        $jsonRecette = json_decode($request->getContent(), true)['recette'];
        if (isset($jsonRecette['id'])) {
            $page = $this->recetteDao->get($jsonRecette['id']);
            foreach ($page->getLayouts() as $layout) {
                $this->em->remove($layout);
            }
        } else {
            $page = new Recette($page);
        }
        $page->setTitre($jsonRecette['titre']);
        foreach ($jsonRecette['layout'] as $jsonLayout) {
            $layout = new Layout();
            $page->addLayout($layout);
            $layout->setItem($jsonLayout['item']);
            $layout->setPosition($jsonLayout['position']);
            $layout->setContenu(json_encode($jsonLayout['contenu']));
            $this->em->persist($layout);
        }

        $this->em->persist($page);
        try {
            $this->em->flush();
        } catch (\Exception $e) {
            PRINT ($e->getMessage());
        }

        return new JsonResponse(["status" => "ok"]);
    }

    public function deleteRecette(Request $request)
    {
        $id = $request->query->get('id');
        $recette = $this->recetteDao->get($id);
        foreach ($recette->getLayouts() as $layout) {
            $this->em->remove($layout);
        }
        $this->em->remove($recette);
        $this->em->flush();

        return new JsonResponse(["status" => "ok"]);
    }

    public function saveCommentaire(Request $request)
    {
        try {
            $jsonCommentaire = json_decode($request->getContent(), true)['commentaire'];
            $recette = $this->recetteDao->get($jsonCommentaire['recetteId']);
            $com = new Commentaires();
            $com->setPseudo($jsonCommentaire['pseudo']);
            $com->setCommentaire($jsonCommentaire['contenu']);
            $com->setMail($jsonCommentaire['mail']);
            $com->setWebsite($jsonCommentaire['website']);
            $com->setRecette($recette);
            $this->em->persist($com);
            $this->em->flush();

            return new JsonResponse(["status" => "ok"]);
        } catch (\Exception $ex) {
            PRINT $ex;
        }
    }

    public function addTag(Request $request)
    {
        $jsonTag = json_decode($request->getContent(), true)['tag']; // [nom, image]
        $tag = new Tags();
        $tag->setNom($jsonTag['nom']);
        $tag->setImage($jsonTag['image']);
        $this->em->persist($tag);
        $this->em->flush();

        return new JsonResponse(["status" => "ok"]);
    }

    public function removeTag(Request $request)
    {
        $jsonTag = json_decode($request->getContent(), true)['tag']; // ['tag':4]
        $tag = $this->tagsDao->get($jsonTag);
        $this->em->remove($tag);
        $this->em->flush();

        return new JsonResponse(["status" => "ok"]);
    }

    public function addTagToRecette(Request $request)
    {
        $params = json_decode($request->getContent(), true); // ['tag':4, 'recette':11]
        $recette = $this->recetteDao->get($params['recette']);
        $tag = $this->tagsDao->get($params['tag']);
        $tag->addRecette($recette);
        $this->em->persist($tag);
        $this->em->flush();

        return new JsonResponse(["status" => "ok"]);
    }

    public function removeTagFromRecette(Request $request)
    {
        $params = json_decode($request->getContent(), true); // ['tag':4, 'recette':11]
        $recette = $this->recetteDao->get($params['recette']);
        $tag = $this->tagsDao->get($params['tag']);
        $tag->removeRecette($recette);
        $this->em->persist($tag);
        $this->em->flush();

        return new JsonResponse(["status" => "ok"]);
    }


}
