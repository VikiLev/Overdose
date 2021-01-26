<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Overdose\Testimonials\Model;

use Magento\Framework\Api\DataObjectHelper;
use Overdose\Testimonials\Api\Data\TestimonialsInterface;
use Overdose\Testimonials\Api\Data\CustomMessageInterfaceFactory;

class CustomMessage extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'overdose_testimonials';
    protected $custommessageDataFactory;

    protected $dataObjectHelper;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param CustomMessageInterfaceFactory $custommessageDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Overdose\Testimonials\Model\ResourceModel\CustomMessage $resource
     * @param \Overdose\Testimonials\Model\ResourceModel\CustomMessage\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        CustomMessageInterfaceFactory $custommessageDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Overdose\Testimonials\Model\ResourceModel\CustomMessage $resource,
        \Overdose\Testimonials\Model\ResourceModel\CustomMessage\Collection $resourceCollection,
        array $data = []
    ) {
        $this->custommessageDataFactory = $custommessageDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve custommessage model with custommessage data
     * @return TestimonialsInterface
     */
    public function getDataModel()
    {
        $custommessageData = $this->getData();

        $custommessageDataObject = $this->custommessageDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $custommessageDataObject,
            $custommessageData,
            TestimonialsInterface::class
        );

        return $custommessageDataObject;
    }
}

