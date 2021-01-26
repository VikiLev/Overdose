<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Overdose\Testimonials\Api\Data;

interface CustomMessageInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const TESTIMONIALS_ID = 'testimonials_id';
    const UPLOAD_PIC = 'upload_pic';
    const TITLE = 'title';
    const MESSAGE = 'message';

    /**
     * @return mixed
     */
    public function getTestimonialsId();

    /**
     * @param $testimonialsId
     * @return mixed
     */
    public function setTestimonialsId($testimonialsId);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \Overdose\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setTitle($title);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Overdose\Testimonials\Api\Data\CustomMessageExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Overdose\Testimonials\Api\Data\CustomMessageExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Overdose\Testimonials\Api\Data\CustomMessageExtensionInterface $extensionAttributes
    );

    /**
     * Get message
     * @return string|null
     */
    public function getMessage();

    /**
     * Set message
     * @param string $message
     * @return \Overdose\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setMessage($message);

    /**
     * Get upload_pic
     * @return string|null
     */
    public function getUploadPic();

    /**
     * Set upload_pic
     * @param string $uploadPic
     * @return \Overdose\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setUploadPic($uploadPic);
}

