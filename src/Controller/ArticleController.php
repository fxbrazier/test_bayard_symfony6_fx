<?php
// src/Controller/ArticleController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\traits\FromXML;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends AbstractController
{
    use FromXML;

    /**
    * @Route("/article/show")
    */
    public function show(): Response
    {
        $xmlFile = $this->getParameter('kernel.project_dir') . '/upload/article1.xml';

        $url = $this->transform($xmlFile);

        return throw new NotFoundHttpException("ArticleNotFound : Aucun article n'a été trouvé pour cette url " . $url);
    }
}