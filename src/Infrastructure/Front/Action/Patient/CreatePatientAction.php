<?php


namespace App\Infrastructure\Front\Action\Patient;


use App\Infrastructure\Front\Form\Type\CreatePatientFormType;
use App\Infrastructure\Utils\Action\Action;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\RouterInterface;

class CreatePatientAction implements Action
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
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(CreatePatientFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->bus->dispatch($form->getData());
                return $this->onSuccess();
            }
        }

        return new Response($this->container->get('twig')->render('front/patient/CreatePatientAction.html.twig', [
            'form' => $form->createView()
        ]));
    }

    /**
     * @return RedirectResponse
     */
    private function onSuccess(): RedirectResponse
    {
        $this->session->getFlashBag()->add('success', 'Patient has been created.');

    }

}