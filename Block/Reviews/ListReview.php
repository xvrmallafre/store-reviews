<?php

namespace Xvrmallafre\StoreReviews\Block\Reviews;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Xvrmallafre\StoreReviews\Model\ResourceModel\Review\CollectionFactory as ReviewCollectionFactory;

/**
 * Class Index
 *
 * @package Xvrmallafre\StoreReviews\Block\Reviews
 */
class ListReview extends Template
{

    /** @var ReviewCollectionFactory $reviewCollection */
    protected $reviewCollection;

    /**
     * Constructor
     *
     * @param ReviewCollectionFactory $reviewCollection
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        ReviewCollectionFactory $reviewCollection,
        Context $context,
        array $data = []
    ) {
        $this->reviewCollection = $reviewCollection;
        parent::__construct($context, $data);
    }

    public function getReviews()
    {
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 10;

        $collection = $this->reviewCollection->create();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);

        return $collection;
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'review.history.pager'
        )->setAvailableLimit([10 => 10, 20 => 20, 50 => 50])
            ->setShowPerPage(true)->setCollection(
                $this->getReviews()
            );
        $this->setChild('pager', $pager);
        $this->getReviews()->load();

        return $this;
    }
}
