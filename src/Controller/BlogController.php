<?php 
namespace App\Controller;
use Symfony\Component\HttpFoundation\Reuest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * @Route("/blog")
 */

class BlogController 
{
    /**
     * @var Twig\Environment
     */
    private $twig;
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param Twig_Environment $twig
     * @param SessionInterface $session
     * @param RouterInterface $router
     */

    public function __construct(
        \Twig\Environment $twig,
        SessionInterface $session,
        RouterInterface $router
    )
    {
        $this->twig = $twig;
        $this->session = $session;
        $this->router = $router;
    }

    /**
     * @Route("/", name="blog_index")
     */
    public function index(){
        $html= $this->twig->render(
            'blog/index.html.twig',
            [
                'posts'=>$this->session->get('posts')
            ]);
        return new Response($html);
    }
    /**
     * @Route("/add", name="blog_add")
     */
    public function add(){
        $posts=$this->session->get('posts');
        $posts[uniqid()]=[
            'title'=> 'A random title'.rand(1,500),
            'text'=>'Some random text'.rand(1,500),
            'date'=> new \DateTime()
        ];
        $this->session->set('posts',$posts);
        return new RedirectResponse($this->router->generate('blog_index'));
    }
    /**
     * @Route("/show/{id}", name="blog_show")
     */
    public function show($id){
        $posts=$this->session->get('posts');
        if(!$posts||!isset($posts[$id])){
            //throw new NotFoundHttpException('Post not found');
        }
        $html=$this->twig->render('blog/post.html.twig',
        [
            'id'=>$id,
            'post'=>$posts[$id]
        ]);

        return new Response($html);
    }
}