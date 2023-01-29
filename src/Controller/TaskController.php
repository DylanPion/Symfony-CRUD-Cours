<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;

class TaskController extends AbstractController
{
    #[Route('/task/create', name: 'app_task_create')]
    public function create(FormFactoryInterface $factory, Request $request, EntityManagerInterface $em): Response
    {
        $builder = $factory->createBuilder(TaskType::class, null, [
            'data_class' => Task::class
        ]);


        $form = $builder->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('task/create.html.twig', [
            'formView' => $form->createView(),
        ]);
    }

    #[Route('/task/{id}/edit', name: 'app_task_edit')]
    public function edit($id, Task $task, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('app_home');
        };

        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'formView' => $form->createView()
        ]);
    }

    #[Route('/task/{id}/delete', name: 'app_task_delete')]
    public function delete(Task $task, EntityManagerInterface $em): Response
    {
        $em->remove($task);
        $em->flush();
        return $this->redirectToRoute('app_home');
    }
}
