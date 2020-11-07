<?php


namespace App\Infrastructure\Front\Action\Home;

use App\Application\Query\CountFieldDayNumbersQuery;
use App\Application\Query\ChartDataDayNumbersQuery;
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
    private $countFieldDayNumbersQuery;
    private $chartDataDayNumbersQuery;

    public function __construct(
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        SessionInterface $session,
        MessageBusInterface $bus,
        CountFieldDayNumbersQuery $countFieldDayNumbersQuery,
        ChartDataDayNumbersQuery $chartDataDayNumbersQuery
    )
    {
        $this->countFieldDayNumbersQuery = $countFieldDayNumbersQuery;
        $this->chartDataDayNumbersQuery = $chartDataDayNumbersQuery;
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
        $totalDeath = $this->countFieldDayNumbersQuery->execute(['field' => 'newDeaths']);
        $totalHealed= $this->countFieldDayNumbersQuery->execute(['field' => 'newHealed' ]);
        $totalNew = $this->countFieldDayNumbersQuery->execute(['field' => 'newCases']);
        $totalNewChatData = $this->chartDataDayNumbersQuery->execute(['type' => 'totalNew']);
        $totalDeathChatData = $this->chartDataDayNumbersQuery->execute(['type' => 'totalDeath']);
        $dailyNewCasesChatData= $this->chartDataDayNumbersQuery->execute(['type' => 'dailyNew']);
        $daysData = $this->chartDataDayNumbersQuery->execute(['type' => 'days']);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->bus->dispatch($form->getData());
                return new RedirectResponse($this->router->generate('home'));
            }
        }
        return new Response($environment->render('front/home/index.html.twig', [
            'form' => $form->createView(),
            'totalDeath' => $totalDeath,
            'totalHealed' => $totalHealed,
            'totalNew' => $totalNew,
            'totalActive' => $totalNew - $totalHealed,
            'labels' => json_encode($daysData),
            'totalNewChatData' => json_encode($totalNewChatData),
            'totalDeathChatData' => json_encode($totalDeathChatData),
            'dailyNewChatData' => json_encode($dailyNewCasesChatData),
        ]));
    }

}