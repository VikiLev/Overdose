<?php

namespace Overdose\Testimonials\Ui\DataProvider;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollection;
use Overdose\Testimonials\Model\ResourceModel\CustomMessage\CollectionFactory as MessageCollection;
use Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider;

class ProductList extends ProductDataProvider
{
    /**
     * Product collection
     *
     * @var \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    protected $collection;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;
    /**
     * @var MessageCollection
     */
    private $messageCollection;

    /**
     * ProductList constructor.
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param ProductCollection $productCollection
     * @param \Magento\Framework\Registry $registry
     * @param array $addFieldStrategies
     * @param array $addFilterStrategies
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ProductCollection $productCollection,
        MessageCollection $messageCollection,
        \Magento\Framework\Registry $registry,
        array $addFieldStrategies = [],
        array $addFilterStrategies = [],
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $productCollection,
            $addFieldStrategies,
            $addFilterStrategies,
            $meta,
            $data
        );
        $messageCollectionData = $messageCollection->create();
        $this->collection = $messageCollectionData;
        $this->addFieldStrategies = $addFieldStrategies;
        $this->addFilterStrategies = $addFilterStrategies;
    }
}
