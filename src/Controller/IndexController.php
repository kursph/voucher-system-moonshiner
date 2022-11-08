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
}
