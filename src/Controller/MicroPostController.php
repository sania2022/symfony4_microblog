<?php 

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Reuest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;

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
    private $formFactory;
    /**
     * @param Twig_Environment $twig
     * @param MicroPostRepository $microPostRepository
    */

    public function __construct(
        \Twig\Environment $twig,
       MicroPostRepository $microPostRepository,
       FormFactoryInterface $formFactory
    )
    {
        $this->twig = $twig;
        $this->microPostRepository = $microPostRepository;
        $this->formFactory=$formFactory;
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

    /**
     * @Route("/add",name="micro_post_add")
     */
    public function add(){

        $microPost= new MicroPost();
        $microPost->setTime(new \DateTime());
        $microPost->setText();
        return new Response(
            $this->twig->render('micro-post/add.html.twig')
        );
    }
}