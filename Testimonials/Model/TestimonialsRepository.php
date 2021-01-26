<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Overdose\Testimonials\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Overdose\Testimonials\Api\TestimonialsRepositoryInterface;
use Overdose\Testimonials\Api\Data\CustomMessageInterfaceFactory;
use Overdose\Testimonials\Api\Data\CustomMessageSearchResultsInterfaceFactory;
use Overdose\Testimonials\Model\ResourceModel\CustomMessage as ResourceCustomMessage;
use Overdose\Testimonials\Model\ResourceModel\CustomMessage\CollectionFactory as CustomMessageCollectionFactory;

class TestimonialsRepository implements TestimonialsRepositoryInterface
{

    private $storeManager;

    protected $dataObjectProcessor;

    private $collectionProcessor;

    protected $customMessageCollectionFactory;

    protected $dataCustomMessageFactory;

    protected $extensibleDataObjectConverter;
    protected $customMessageFactory;

    protected $searchResultsFactory;

    protected $extensionAttributesJoinProcessor;

    protected $resource;

    protected $dataObjectHelper;


    /**
     * @param ResourceCustomMessage $resource
     * @param CustomMessageFactory $customMessageFactory
     * @param CustomMessageInterfaceFactory $dataCustomMessageFactory
     * @param CustomMessageCollectionFactory $customMessageCollectionFactory
     * @param CustomMessageSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceCustomMessage $resource,
        CustomMessageFactory $customMessageFactory,
        CustomMessageInterfaceFactory $dataCustomMessageFactory,
        CustomMessageCollectionFactory $customMessageCollectionFactory,
        CustomMessageSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->customMessageFactory = $customMessageFactory;
        $this->customMessageCollectionFactory = $customMessageCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomMessageFactory = $dataCustomMessageFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Overdose\Testimonials\Api\Data\TestimonialsInterface $customMessage
    ) {
        /* if (empty($customMessage->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $customMessage->setStoreId($storeId);
        } */

        $customMessageData = $this->extensibleDataObjectConverter->toNestedArray(
            $customMessage,
            [],
            \Overdose\Testimonials\Api\Data\TestimonialsInterface::class
        );

        $customMessageModel = $this->customMessageFactory->create()->setData($customMessageData);

        try {
            $this->resource->save($customMessageModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customMessage: %1',
                $exception->getMessage()
            ));
        }
        return $customMessageModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($testimonialsId)
    {
        $customMessage = $this->customMessageFactory->create();
        $this->resource->load($customMessage, $testimonialsId);
        if (!$customMessage->getId()) {
            throw new NoSuchEntityException(__('Testimonials with id "%1" does not exist.', $testimonialsId));
        }
        return $customMessage->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->customMessageCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Overdose\Testimonials\Api\Data\TestimonialsInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Overdose\Testimonials\Api\Data\TestimonialsInterface $customMessage
    ) {
        try {
            $customMessageModel = $this->customMessageFactory->create();
            $this->resource->load($customMessageModel, $customMessage->getTestimonialsId());
            $this->resource->delete($customMessageModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Testimonials: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($testimonialsId)
    {
        return $this->delete($this->get($testimonialsId));
    }
}

