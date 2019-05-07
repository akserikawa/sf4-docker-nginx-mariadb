<?php

namespace App\Controller;

use App\Repository\VisitRepository;
use App\Service\VisitLogger;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{

    /**
     * @var VisitLogger
     */
    private $logger;
    /**
     * @var VisitRepository
     */
    private $repository;

    public function __construct(VisitLogger $logger, VisitRepository $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }

    /**
     * @Route("/", name="index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $ip = $request->getClientIp();

        $this->logger->log(
            $ip,
            new DateTime()
        );

        $visitsFromThisIp = $this->repository->getVisitCountForIp($ip);
        $allVisits = $this->repository->findAll();

        return $this->render('index/index.html.twig', [
            'visitsFromThisIp' => $visitsFromThisIp,
            'allVisits' => $allVisits
        ]);
    }
}
