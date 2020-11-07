<?php


namespace App\Infrastructure\Back\Action\DayNumbers;


use App\Infrastructure\Back\Form\Type\CreateDayNumbersFormType;
use App\Infrastructure\Utils\Action\Action;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CreateDayNumbersAction implements Action
{
    private $container;
    private $router;
    private $formFactory;
    private $session;
    private $translator;
    private $bus;

    public function __construct(
        ContainerInterface $container,
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        SessionInterface $session,
        TranslatorInterface $translator,
        MessageBusInterface $bus
    )
    {
        $this->container = $container;
        $this->router = $router;
        $this->translator = $translator;
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
        $form = $this->formFactory->create(CreateDayNumbersFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->bus->dispatch($form->getData());
                return $this->onSuccess();
            }
        }

        return new Response($this->container->get('twig')->render('back/dayNumbers/CreateDayNumbersAction.html.twig', [
            'form' => $form->createView()
        ]));
    }

    /**
     * @return RedirectResponse
     */
    private function onSuccess(): RedirectResponse
    {
        $this->session->getFlashBag()->add('success', $this->translator->trans('dayNumbers.createDayNumbersAction.form.success',[],'dayNumbers'));

        return new RedirectResponse($this->router->generate('admin_day_numbers_list'));
    }

}