<?php


namespace App\Infrastructure\Back\Action\DayNumbers;

use App\Application\Query\ListDayNumbersQuery;
use App\Infrastructure\Utils\Action\Action;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError as LoaderErrorAlias;
use Twig\Error\RuntimeError as RuntimeErrorAlias;
use Twig\Error\SyntaxError as SyntaxErrorAlias;

class ListDayNumbersAction implements Action
{
    private $query;

    public function __construct(ListDayNumbersQuery $query)
    {
        $this->query = $query;
    }

    /**
     * @param Request $request
     * @param Environment $environment
     * @return Response
     * @throws LoaderErrorAlias
     * @throws RuntimeErrorAlias
     * @throws SyntaxErrorAlias
     */
    public function __invoke(Request $request, Environment $environment): Response
    {
        return new Response($environment->render('back/dayNumbers/ListDayNumbersAction.html.twig', [
            'dayNumbers' => $this->query->execute(),
        ]));
    }

}