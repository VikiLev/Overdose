<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Overdose\Testimonials\Api\Data;

interface CustomMessageSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Testimonials list.
     * @return \Overdose\Testimonials\Api\Data\TestimonialsInterface[]
     */
    public function getItems();

    /**
     * Set title list.
     * @param \Overdose\Testimonials\Api\Data\TestimonialsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

