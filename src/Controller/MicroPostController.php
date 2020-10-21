<?php


namespace App\Controller;

use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MicroPostController
 * @Route("/micro-post")
 */
class MicroPostController
{
    /**
     * @var \Twig\Environment
     */
    private $twig;
    /**
     * @var MicroPostRepository
     */
    private $microPostRepository;

    public function __construct(
        \Twig\Environment $twig,MicroPostRepository $microPostRepository
    )
    {
        $this->twig=$twig;
        $this->microPostRepository=$microPostRepository;
    }
    /**
     * @Route("/",name="micro_post_index")
     */
    public function index(){
        $html= $this->twig->render('micro-post/index.html.twig', [
            'posts'=>$this->microPostRepository->findAll()
        ]);
        return new Response($html);
    }
}