<?php

namespace Xvrmallafre\StoreReviews\Block\Reviews;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Xvrmallafre\StoreReviews\Model\ResourceModel\Review\Collection;
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

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return $this|Template
     * @throws LocalizedException
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $pager = $this->getLayout()->createBlock(
            'Magento\Catalog\Block\Product\Widget\Html\Pager',
            'review.history.pager'
        )->setAvailableLimit([10 => 10, 20 => 20, 50 => 50])
            ->setShowPerPage(true)->setCollection(
                $this->getReviews()
            );
        $this->setChild('pager', $pager);
        $this->getReviews()->load();

        $this->pageConfig->getTitle()->set(__('Reviews'));

        return $this;
    }

    /**
     * @return Collection
     */
    public function getReviews()
    {
        //TODO: This method should be part of a controller. It's cached.
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 10;

        $collection = $this->reviewCollection->create();
        $collection->addFieldToFilter('visible', true);
        $collection->addFieldToFilter('submitted_at', ['neq' => 'NULL']);
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        $collection->setOrder('review_id', $collection::SORT_ORDER_DESC);

        return $collection;
    }
}
