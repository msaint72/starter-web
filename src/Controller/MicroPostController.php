<?php


namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostType;
use App\Repository\MicroPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

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
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var RouterInterface
     */
    private  $router;
    /**
     * @var FlashBagInterface
     */

    private $flashBag;
    public function __construct(
        \Twig\Environment $twig,
        MicroPostRepository $microPostRepository,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        RouterInterface $router,
        FlashBagInterface $flashBag
    )
    {
        $this->twig=$twig;
        $this->microPostRepository=$microPostRepository;
        $this->formFactory = $formFactory;
        $this->entityManager=$entityManager;
        $this->router=$router;
        $this->flashBag=$flashBag;
    }
    /**
     * @Route("/",name="micro_post_index")
     */
    public function index(){
        $html= $this->twig->render('micro-post/index.html.twig', [
            'posts'=>$this->microPostRepository->findBy([],['time'=>'DESC'])
        ]);
        return new Response($html);
    }

    /**
     * @param MicroPost $microPost
     * @param Request $request
     * @Route ("/edit/{id}",name="micro_post_edit")
     */
    public function edit(MicroPost  $micro_post,Request  $request){
        $form=$this->formFactory->create(MicroPostType::class,$micro_post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($micro_post);
            $this->entityManager->flush();
            return new RedirectResponse($this->router->generate('micro_post_index'));

        }
        return new Response($this->twig->render('/micro-post/add.html.twig',['form'=>$form->createView()]));
    }

    /**
     * @Route ("/delete/{id}",name="micro_post_delete")
     */
    public function delete(MicroPost $microPost){
        $id=$microPost->getId();
        $this->entityManager->remove($microPost);
        $this->entityManager->flush();
        $this->flashBag->add('notice','Micro post deleted:'. $id);
        return new RedirectResponse($this->router->generate('micro_post_index'));

    }
    /**
     * @Route("/add",name="micro_post_add")
     */
    public function add(Request $request){
        $micro_post = new MicroPost();
        $micro_post->setTime(new \DateTime());

        $form=$this->formFactory->create(MicroPostType::class,$micro_post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($micro_post);
            $this->entityManager->flush();
            return new RedirectResponse($this->router->generate('micro_post_index'));

        }
        return new Response($this->twig->render('/micro-post/add.html.twig',['form'=>$form->createView()]));
    }

    /**
     * @Route("/{id}",name="micro_post_post")
     */
    public function post(MicroPost  $post){
        //$post=$this->microPostRepository->find(MicroPost:: $post);

        return new Response(
            $this->twig->render('micro-post/post.html.twig',['post'=>$post])

        );
    }
}