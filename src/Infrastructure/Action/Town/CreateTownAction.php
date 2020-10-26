<?php


namespace App\Infrastructure\Action\Town;


use App\Infrastructure\Action\Action;
use App\Infrastructure\Form\Type\CreateTownFormType;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\RouterInterface;

class CreateTownAction implements Action
{
    private $container;
    private $router;
    private $formFactory;
    private $session;
    private $bus;

    public function __construct(
        ContainerInterface $container,
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        SessionInterface $session,
        MessageBusInterface $bus
    )
    {
        $this->container = $container;
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->session = $session;
        $this->bus = $bus;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(CreateTownFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->bus->dispatch($form->getData());
                return $this->onSuccess();
            }
        }

        return Response::create($this->container->get('twig')->render('town/CreateTownAction.html.twig', [
            'form' => $form->createView()
        ]));
    }

    private function onSuccess(): RedirectResponse
    {
        $this->session->getFlashBag()->add('success', 'Town has been created.');

        return new RedirectResponse($this->router->generate('town_list'));
    }

}