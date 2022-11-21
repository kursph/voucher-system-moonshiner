<?php

namespace App\Controller;

use App\Entity\Voucher;

use App\Event\VoucherEvent;
use App\EventListener\VoucherCreatedListener;
use App\Form\VoucherEType;
use App\Form\VoucherType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoucherController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/voucher/create', name: 'app_voucher_create')]
    public function create(Request $request): Response
    {
        $voucher = new Voucher();
        $form = $this->createForm(VoucherEType::class, $voucher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = new VoucherEvent(VoucherEvent::VOUCHER_CREATED, $voucher);
            $listener = new VoucherCreatedListener();
            $dispatcher = new EventDispatcher();
            $dispatcher->addSubscriber($listener);
            $dispatcher->dispatch($event, $event->getEventName());

            $this->entityManager->persist($voucher);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('voucher/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/voucher/delete/{id}', name: 'app_voucher_delete')]
    public function delete(Request $request, int $id): Response
    {
        $voucher = $this->entityManager->getRepository(Voucher::class)->find($id);

        $this->entityManager->remove($voucher);
        $this->entityManager->flush();

        $this->addFlash('success', 'Voucher Deleted!');

        return $this->redirectToRoute('app_index');
    }
}
