<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Overdose\Testimonials\Model\Data;

use Overdose\Testimonials\Api\Data\TestimonialsInterface;

class Testimonials extends \Magento\Framework\Api\AbstractExtensibleObject implements TestimonialsInterface
{

    /**
     * @return mixed|null
     */
    public function getTestimonialsId()
    {
        return $this->_get(self::TESTIMONIALS_ID);
    }

    /**
     * @param $testimonialsId
     * @return mixed|Testimonials
     */
    public function setTestimonialsId($testimonialsId)
    {
        return $this->setData(self::TESTIMONIALS_ID, $testimonialsId);
    }

    /**
     * Get title
     * @return string|null
     */
    public function getTitle()
    {
        return $this->_get(self::TITLE);
    }

    /**
     * Set title
     * @param string $title
     * @return \Overdose\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Overdose\Testimonials\Api\Data\CustomMessageExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Overdose\Testimonials\Api\Data\CustomMessageExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Overdose\Testimonials\Api\Data\CustomMessageExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get message
     * @return string|null
     */
    public function getMessage()
    {
        return $this->_get(self::MESSAGE);
    }

    /**
     * Set message
     * @param string $message
     * @return \Overdose\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * Get upload_pic
     * @return string|null
     */
    public function getUploadPic()
    {
        return $this->_get(self::UPLOAD_PIC);
    }

    /**
     * Set upload_pic
     * @param string $uploadPic
     * @return \Overdose\Testimonials\Api\Data\TestimonialsInterface
     */
    public function setUploadPic($uploadPic)
    {
        return $this->setData(self::UPLOAD_PIC, $uploadPic);
    }
}

