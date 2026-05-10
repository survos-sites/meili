<?php

namespace App\Controller;

use League\Flysystem\FilesystemOperator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Target;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FlysystemController extends AbstractController
{
    #[Route('/flysystem_default', name: 'flysystem_browse_default')]
    public function default(#[Target('defaultStorage')] FilesystemOperator $defaultStorage): Response
    {
        return $this->render('flysystem/index.html.twig', [
            'images' => $defaultStorage->listContents('/', deep: false),
            'controller_name' => 'FlysystemController',
        ]);
    }

}
