<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Property;
use App\Form\PropertyType;

class AdminPropertyController extends AbstractController
{
    public function __construct(PropertyRepository $repository)
    {
        $this->repository =$repository;
    }

    /**
    *@Route("/admin", name="admin.property.index")
    */
    public function index()
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }

     /**
    *@Route("/admin/{id}", name="admin.property.edit")
    */
    public function edit(Property $property){
        $form = $this->createForm(PropertyType::class, $property);
        return $this->render('admin/property/edit.html.twig', [
        'property' => $property,
        'form' => $form->createView(),
    ]);
    }
}
