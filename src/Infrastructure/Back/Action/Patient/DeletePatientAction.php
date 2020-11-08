<?php


namespace App\Infrastructure\Back\Action\Patient;


use App\Application\Command\DeletePatientCommand;
use App\Domain\Model\Patient\Patient;
use App\Infrastructure\Utils\Action\Action;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class DeletePatientAction implements Action
{
    private $router;
    private $session;
    private $translator;
    private $bus;

    public function __construct(
        RouterInterface $router,
        SessionInterface $session,
        TranslatorInterface $translator,
        MessageBusInterface $bus
    )
    {
        $this->router = $router;
        $this->translator = $translator;
        $this->session = $session;
        $this->bus = $bus;
    }

    /**
     * @param Request $request
     * @param Patient $patient
     * @return Response
     */
    public function __invoke(Request $request, Patient $patient): Response
    {
        $deletePatientCommand = new DeletePatientCommand($patient->getId());
        $this->bus->dispatch($deletePatientCommand);
        return $this->onSuccess();
    }

    /**
     * @return RedirectResponse
     */
    private function onSuccess(): RedirectResponse
    {
        $this->session->getFlashBag()->add('success', $this->translator->trans('patient.createPatientAction.form.delete.success', [], 'patient'));

        return new RedirectResponse($this->router->generate('admin_back_patient_list'));
    }

}