<?php


namespace App\Infrastructure\Back\Action\Patient;


use App\Domain\Model\Patient\Patient;
use App\Infrastructure\Back\Form\Type\UpdatePatientFormType;
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
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class UpdatePatientAction implements Action
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
     * @param Patient $patient
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(Request $request, Patient $patient): Response
    {
        $form = $this->formFactory->create(UpdatePatientFormType::class, $patient);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->bus->dispatch($form->getData());
                return $this->onSuccess();
            }
        }

        return new Response($this->container->get('twig')->render('back/patient/CreatePatientAction.html.twig', [
            'form' => $form->createView()
        ]));
    }

    /**
     * @return RedirectResponse
     */
    private function onSuccess(): RedirectResponse
    {
        $this->session->getFlashBag()->add('success', $this->translator->trans('patient.createPatientAction.form.update.success', [], 'patient'));

        return new RedirectResponse($this->router->generate('admin_back_patient_list'));
    }

}