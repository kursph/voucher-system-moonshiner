<?php

namespace App\Controller;

use App\Entity\Voucher;
use App\Entity\VoucherRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoucherRegistryController extends AbstractController
{
    #[Route('/voucher/registry', name: 'app_voucher_registry')]
    public function index(): Response
    {
        return $this->render('voucher_registry/index.html.twig', [
            'controller_name' => 'VoucherRegistryController',
        ]);
    }

    #[Route('/voucher/registry/{id}/add', name: 'app_voucher_registry_add')]
    public function add(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $request->request->get('userName');
        $voucher = $entityManager->getRepository(Voucher::class)->find($id);

        $voucherRegistry = new VoucherRegistry('test', $id, new \DateTime());

        $entityManager->persist($voucherRegistry);
        $entityManager->flush();

        $this->addFlash('success', 'Voucher Added!');

        return $this->redirectToRoute('app_index');
    }

    #[Route('/voucher/registry/list', name: 'app_voucher_registry_list')]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userName = $request->request->get('userName');
        $vouchersList = $entityManager->getRepository(VoucherRegistry::class)->findBy(['userName' => $userName]);

        return $this->render('voucher_registry/list.html.twig', [
            'vouchersList' => $vouchersList,
        ]);
    }
}
