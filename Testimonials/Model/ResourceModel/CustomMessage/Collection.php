<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Overdose\Testimonials\Model\ResourceModel\CustomMessage;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'testimonials_id';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init(
            \Overdose\Testimonials\Model\CustomMessage::class,
            \Overdose\Testimonials\Model\ResourceModel\CustomMessage::class
        );
    }
}

