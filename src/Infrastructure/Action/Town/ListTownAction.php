<?php


namespace App\Infrastructure\Action\Town;

use App\Application\Query\ListTownQuery;
use App\Infrastructure\Action\Action;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ListTownAction implements Action
{
    private $query;

    public function __construct(ListTownQuery $query)
    {
        $this->query = $query;
    }

    public function __invoke(Request $request, Environment $environment): Response
    {
        return Response::create($environment->render('town/ListTownAction.html.twig', [
            'towns' => $this->query->execute(),
        ]));
    }

}