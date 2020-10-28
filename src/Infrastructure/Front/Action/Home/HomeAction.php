<?php


namespace App\Infrastructure\Front\Action\Home;

use App\Infrastructure\Front\Form\Type\ContactFormType;
use App\Infrastructure\Utils\Action\Action;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeAction implements Action
{
    private $router;
    private $formFactory;
    private $session;
    private $bus;

    public function __construct(
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        SessionInterface $session,
        MessageBusInterface $bus
    )
    {
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->session = $session;
        $this->bus = $bus;
    }

    /**
     * @param Request $request
     * @param Environment $environment
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(Request $request, Environment $environment): Response
    {
        $form = $this->formFactory->create(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->bus->dispatch($form->getData());
                return new RedirectResponse($this->router->generate('home'));
            }
        }

        return new Response($environment->render('front/home/index.html.twig', [
            'form' => $form->createView()
        ]));
    }

}