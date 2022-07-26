<?php 

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Reuest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/micro-post")
 */
class MicroPostController extends AbstractController{

/**
     * @var Twig\Environment
     * 
     */
    private $twig;
   /**
     * @var microPostRepository
     */
    private $microPostRepository;

    /**
     * @param Twig_Environment $twig
     * @param MicroPostRepository $microPostRepository
    */

    public function __construct(
        \Twig\Environment $twig,
       MicroPostRepository $microPostRepository
    )
    {
        $this->twig = $twig;
        $this->microPostRepository = $microPostRepository;
    }


    /**
     * @Route("/", name="micro_post_index")
     */
    public function index(){
        $html=$this->twig->render('micro-post/index.html.twig',[
            'posts'=>$this->microPostRepository->findAll()
        ]);

        return new Response($html);
    }
}