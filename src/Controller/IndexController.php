<?php

namespace App\Controller;

use App\Entity\Voucher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vouchers = $entityManager->getRepository(Voucher::class)->findAll();

        return $this->render('index/index.html.twig', [
            'vouchers' => $vouchers,
        ]);
    }

    #[Route('/index/{type}', name: 'app_index_type')]
    public function indexByType(Request $request, EntityManagerInterface $entityManager, string $type): Response
    {
        switch ($type) {
            case 'valid':
                $vouchers = $entityManager->getRepository(Voucher::class)->findAllValid();
                break;
            case 'pending':
                $vouchers = $entityManager->getRepository(Voucher::class)->findAllPending();
                break;
            case 'expired':
                $vouchers = $entityManager->getRepository(Voucher::class)->findAllExpired();
                break;
            default:
                $this->redirectToRoute('app_index');
        }

        return $this->render('index/index.html.twig', [
            'vouchers' => $vouchers,
        ]);
    }
}
