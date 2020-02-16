<?php

namespace Xvrmallafre\StoreReviews\Cron;

/**
 * Class Crontab
 *
 * @package Xvrmallafre\StoreReviews\Cron
 */
class Crontab
{

    protected $logger;

    /**
     * Constructor
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute()
    {
        $this->logger->addInfo('Cronjob Crontab is executed.');
    }
}
