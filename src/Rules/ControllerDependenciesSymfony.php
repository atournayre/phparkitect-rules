<?php
declare(strict_types=1);

namespace Atournayre\PHPArkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Expression\ForClasses\DependsOnlyOnTheseNamespaces;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Atournayre\PHPArkitect\Contracts\RulesInterface;

class ControllerDependenciesSymfony implements RulesInterface
{
    public function that(): Expression
    {
        return new ResideInOneOfTheseNamespaces('App\Controller');
    }

    public function should(): Expression
    {
        return new DependsOnlyOnTheseNamespaces('App\Entity','App\Form','App\Service','Psr\Log\LoggerInterface','Symfony\Bundle\FrameworkBundle\Controller\AbstractController','Symfony\Component\HttpFoundation\JsonResponse','Symfony\Component\HttpFoundation\RedirectResponse','Symfony\Component\HttpFoundation\Request','Symfony\Component\HttpFoundation\Response','Symfony\Component\Security\Http\Attribute\IsGranted','Symfony\Component\Routing\RouterInterface',);
    }

    public function because(): string
    {
        return 'Controller should have dependency on AbstractController, Response, Request, RedirectResponse, JsonResponse, IsGranted attribute from Symfony Security, Entity, Form and Service';
    }
}
