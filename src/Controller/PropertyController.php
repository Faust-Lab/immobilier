<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PropertyRepository;
use App\Entity\Property;
use Doctrine\Common\Persistence\ObjectManager;

class PropertyController extends AbstractController
{
    public function __construct(PropertyRepository $repository, ObjectManager $objectManager)
    {
        $this->repository = $repository;
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("/biens", name="property.index")
     */
    public function index(): Response
    {
       $property = $this->repository->findAllVisible();
        
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'property' => $property,
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     */
     public function show(Property $property): Response
     {

         return $this->render('property/show.html.twig', [
             'current_menu' => 'properties',
             'property' => $property,
         ]);
     }
}
