<?php

namespace App\Service;

use App\Entity\Visit;
use App\Repository\VisitRepository;
use DateTime;

class VisitFactory
{
    /**
     * @var VisitRepository
     */
    private $repository;

    public function __construct(VisitRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(string $ip, DateTime $dateTime): Visit
    {
        return (new Visit())->setIp($ip)->setTimestamp($dateTime);
    }

}
