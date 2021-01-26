<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Overdose\Testimonials\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CustomMessageRepositoryInterface
{

    /**
     * @param Data\TestimonialsInterface $customMessage
     * @return mixed
     */
    public function save(
        \Overdose\Testimonials\Api\Data\TestimonialsInterface $customMessage
    );

    /**
     * @param $testimonialsId
     * @return mixed
     */
    public function get($testimonialsId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * @param Data\TestimonialsInterface $customMessage
     * @return mixed
     */
    public function delete(
        \Overdose\Testimonials\Api\Data\TestimonialsInterface $customMessage
    );

    /**
     * @param $testimonialsId
     * @return mixed
     */
    public function deleteById($testimonialsId);
}

