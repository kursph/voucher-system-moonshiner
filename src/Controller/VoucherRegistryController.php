<?php

namespace App\Controller;

use App\Entity\Voucher;
use App\Entity\VoucherRegistry;
use App\Service\VoucherRegistryHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoucherRegistryController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    private VoucherRegistryHelper $voucherRegistryHelper;

    public function __construct(EntityManagerInterface $entityManager, VoucherRegistryHelper $voucherRegistryHelper)
    {
        $this->voucherRegistryHelper = $voucherRegistryHelper;
        $this->entityManager = $entityManager;
    }

    #[Route('/voucher/registry/{id}/add', name: 'app_voucher_registry_add')]
    public function add(Request $request, int $id): Response
    {
        $user = $request->request->get('userName');
        $voucher = $this->entityManager->getRepository(Voucher::class)->find($id);

        $voucherRegistry = new VoucherRegistry('test', $voucher, new \DateTime());

        $this->entityManager->persist($voucherRegistry);
        $this->entityManager->flush();

        $this->addFlash('success', 'Voucher Added!');

        return $this->redirectToRoute('app_index');
    }

    #[Route('/voucher/registry/list', name: 'app_voucher_registry_list')]
    public function edit(Request $request): Response
    {
        $userName = $request->request->get('userName');
        $voucherRegistries = $this->entityManager->getRepository(VoucherRegistry::class)->findBy(['userName' => $userName]);
        $vouchersList = $this->voucherRegistryHelper->getVouchersList($voucherRegistries);

        return $this->render('voucher_registry/list.html.twig', [
            'voucherRegistries' => $voucherRegistries,
            'vouchersList' => $vouchersList,
        ]);
    }

    #[Route('/voucher/registry/{id}/delete', name: 'app_voucher_registry_delete')]
    public function delete(Request $request, int $id): Response
    {
        $userName = $request->request->get('userName');
        $voucherRegistry = $this->entityManager->getRepository(VoucherRegistry::class)->findOneBy(['id' => $id]);
        $this->entityManager->remove($voucherRegistry);
        $this->entityManager->flush();

        $this->addFlash('success', 'Voucher Registry Deleted!');

        return $this->redirectToRoute('app_index');
    }
}
