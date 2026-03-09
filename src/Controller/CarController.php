<?php

namespace App\Controller;

use Survos\CoreBundle\Entity\RouteParametersInterface;
use Survos\CoreBundle\Entity\RouteParametersTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarController extends AbstractController implements RouteParametersInterface
{
    use RouteParametersTrait;

    public const UNIQUE_PARAMETERS=['carId' => 'id'];
    #[Route('/car/show/{carId}', name: 'car_show', options: ['expose' => true])]
    public function show(Car $car): Response
    {
        return $this->render('car/index.html.twig', [
            'car' => $car,
        ]);
    }
}
