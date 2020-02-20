<?php

namespace Xvrmallafre\StoreReviews\Plugin;

use Exception;
use Magento\Framework\Math\Random;
use Magento\Sales\Model\Order as OrderModel;
use Magento\Sales\Model\ResourceModel\Order;
use Psr\Log\LoggerInterface;
use Xvrmallafre\StoreReviews\Api\Data\ReviewInterfaceFactory;
use Xvrmallafre\StoreReviews\Api\ReviewRepositoryInterface;

/**
 * Class OrderStatePlugin
 * @package Xvrmallafre\StoreReviews\Model\Plugin
 */
class OrderStatePlugin
{

    /**
     * @var ReviewRepositoryInterface
     */
    protected $reviewRepository;

    /**
     * @var ReviewInterfaceFactory
     */
    protected $reviewInterfaceFactory;

    /**
     * @var Random
     */
    protected $randomizer;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * OrderStatePlugin constructor.
     * @param ReviewRepositoryInterface $reviewRepository
     * @param ReviewInterfaceFactory $reviewInterfaceFactory
     * @param Random $randomizer
     * @param LoggerInterface $logger
     */
    public function __construct(
        ReviewRepositoryInterface $reviewRepository,
        ReviewInterfaceFactory $reviewInterfaceFactory,
        Random $randomizer,
        LoggerInterface $logger
    ) {
        $this->reviewRepository = $reviewRepository;
        $this->reviewInterfaceFactory = $reviewInterfaceFactory;
        $this->randomizer = $randomizer;
        $this->logger = $logger;
    }

    /**
     * @param Order $subject
     * @param OrderModel $result
     * @param $object
     * @return mixed
     */
    public function afterSave(
        Order $subject,
        $result,
        $object
    ) {
        if (
            $object->getOrigData('status') !== $object->getData('status')
            && $object->getData('status') === OrderModel::STATE_COMPLETE
        ) {
            try {
                $reviewToSave = $this->reviewInterfaceFactory->create();
                $reviewToSave->setDelivery(0)
                    ->setProduct(0)
                    ->setCustomerSupport(0)
                    ->setComment(null)
                    ->setIncrementId($object->getIncrementId())
                    ->setSubmittedAt(null)
                    ->setVisible(false)
                    ->setIsMsgSent(false)
                    ->setHash($this->randomizer->getRandomString(64));
                $this->reviewRepository->save($reviewToSave);
            } catch (Exception $e) {
                $this->logger->error('OrderStatePlugin: ' . $e->getMessage());
            }
        }

        return $result;
    }
}
