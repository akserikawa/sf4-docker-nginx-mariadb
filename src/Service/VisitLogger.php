<?php

namespace App\Service;

use App\Entity\Visit;
use App\Repository\VisitRepository;
use DateTime;

class VisitLogger
{
    /**
     * @var VisitRepository
     */
    private $repository;
    /**
     * @var VisitFactory
     */
    private $visitFactory;

    public function __construct(VisitFactory $visitFactory, VisitRepository $repository)
    {
        $this->repository = $repository;
        $this->visitFactory = $visitFactory;
    }

    public function log(string $ip, DateTime $date): void
    {
        $this->repository->save(
            $this->visitFactory->create($ip, $date)
        );
    }
}
