<?php


namespace App\Infrastructure\Back\Action\Patient;


use App\Application\Command\DeletePatientCommand;
use App\Domain\Model\Patient\Patient;
use App\Infrastructure\Utils\Action\Action;
use Psr\Container\ContainerInterface;
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

class ViewPatientAction implements Action
{
    private $router;
    private $session;
    private $translator;
    private $bus;
    private $container;
    public function __construct(
        ContainerInterface $container,
        RouterInterface $router,
        SessionInterface $session,
        TranslatorInterface $translator,
        MessageBusInterface $bus
    )
    {
        $this->container = $container;
        $this->router = $router;
        $this->translator = $translator;
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
        return new Response($this->container->get('twig')->render('back/patient/ViewPatientAction.html.twig', [
            'patient' => $patient
        ]));
    }


}