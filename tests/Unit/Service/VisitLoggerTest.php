<?php

namespace tests\Unit\Service;

use App\Repository\VisitRepository;
use App\Service\VisitFactory;
use App\Service\VisitLogger;
use DateTime;
use PHPUnit\Framework\TestCase;

class VisitLoggerTest extends TestCase
{
    public function testThatLoggingWorks()
    {
        $now = new DateTime();
        $ip = '127.0.0.1';

        $mockFactory = $this->getMockBuilder(VisitFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockRepo = $this->getMockBuilder(VisitRepository::class)->disableOriginalConstructor()->getMock();

        $mockFactory->expects($this->once())
            ->method('create')
            ->with(
                $ip,
                $now
            );

        $logger = new VisitLogger($mockFactory, $mockRepo);

        $logger->log($ip, $now);
    }
}
