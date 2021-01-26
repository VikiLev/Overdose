<?php

namespace Overdose\Testimonials\Block\Frontend;

use Magento\Framework\View\Element\Template;
use Overdose\Testimonials\Model\ResourceModel\CustomMessage\CollectionFactory;

/**
 * Class Testimonials
 * @package Overdose\Testimonials\Block\Frontend
 */
class CustomMessage extends Template
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * Testimonials constructor.
     * @param CollectionFactory $collectionFactory
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(CollectionFactory $collectionFactory,
                                Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function getMessageCollection()
    {
        $messageCollection = $this->collectionFactory->create();
        $items = $messageCollection->getItems();
        $data = [];
        foreach ($items as $item){
            $message = $item->getData('message');
            $title = $item->getData('title');
            $data[] = ['message'=> $message, 'title'=> $title];
        }
        return $data;

    }
}

