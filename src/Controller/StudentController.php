<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    #[Route('/liststudent', name: 'list_student')]
    public function listStudent(StudentRepository $repository)
    {
        $student= $repository->findAll();
        // $student= $this->getDoctrine()->getRepository(StudentRepository::class)->findAll();
        return $this->render("student/list.html.twig",array("tabStudent"=>$student));
    }

    #[Route('/addF', name: 'add1')]
    public function addForm(ManagerRegistry $doctrine,Request $request,StudentRepository $repository)
    {
        $student= new student();
        $form= $this->createForm(StudentType::class,$student);
        $form->handleRequest($request) ;
        if ($form->isSubmitted()){
            $repository->add($student,true);
           // $em= $doctrine->getManager();
           // $em->persist($student);
         //   $em->flush();
            return  $this->redirectToRoute("list_student");
        }
        return $this->renderForm("student/add.html.twig",array("formStudent"=>$form));
    }

    #[Route('/updateF/{Nce}', name: 'update1')]
    public function  updateForm($Nce,StudentRepository $repository,ManagerRegistry $doctrine,Request $request)
    {
        $student= $repository->find($Nce);
        $form= $this->createForm(StudentType::class,$student);
        $form->handleRequest($request) ;
        if ($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->flush();
            return  $this->redirectToRoute("list_student");
        }
        return $this->renderForm("student/update.html.twig",array("formStudent"=>$form));
    }

    #[Route('/removeF/{Nce}', name: 'remove1')]

    public function removeStudent(ManagerRegistry $doctrine,$Nce,StudentRepository $repository)
    {
        $student= $repository->find($Nce);
        $em = $doctrine->getManager();
        $em->remove($student);
        $em->flush();
        return  $this->redirectToRoute("list_student");
    }




}
