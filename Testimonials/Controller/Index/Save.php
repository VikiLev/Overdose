<?php

namespace Overdose\Testimonials\Controller\Index;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\Framework\Image\AdapterFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Overdose\Testimonials\Api\Data\CustomMessageInterfaceFactory;
use Overdose\Testimonials\Api\TestimonialsRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;


class Save extends Action
{
    /**
     * @var TestimonialsRepositoryInterface
     */
    private $orderRepository;
    /**
     * @var CustomMessageInterfaceFactory
     */
    private $orderInterfaceFactory;

    private $uploaderFactory;

    private $adapterFactory;

    private $filesystem;

    /**
     * Save constructor.
     * @param Context $context
     * @param TestimonialsRepositoryInterface $orderRepository
     * @param CustomMessageInterfaceFactory $orderInterfaceFactory
     * @param UploaderFactory $uploaderFactory
     * @param AdapterFactory $adapterFactory
     * @param Filesystem $filesystem
     */
    public function __construct(
        Context $context,
        TestimonialsRepositoryInterface $orderRepository,
        CustomMessageInterfaceFactory $orderInterfaceFactory,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem
    )
    {
        parent::__construct($context);

        $this->orderInterfaceFactory = $orderInterfaceFactory;
        $this->orderRepository = $orderRepository;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws LocalizedException
     */
    public function execute()
    {
        try {
            $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'image']);
            $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $imageAdapter = $this->adapterFactory->create();
            /* start of validated image */
            $uploaderFactory->addValidateCallback('custom_image_upload',
                $imageAdapter, 'validateUploadFile');
            $uploaderFactory->setAllowRenameFiles(true);
            $uploaderFactory->setFilesDispersion(true);
            $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
            $destinationPath = $mediaDirectory->getAbsolutePath('custom_image');
            $result = $uploaderFactory->save($destinationPath);
            if (!$result) {
                throw new LocalizedException(
                    __('File cannot be saved to path: $1', $destinationPath)
                );
            }

        } catch (\Exception $e) {

        }
        $params = $this->getRequest()->getParams();

        $model = $this->orderInterfaceFactory->create();

        $model->setTitle($params['title']);
        $model->setMessage($params['message']);
        if (isset($result['file']))
        {
            $model->setUploadPic($result['file']);
        }
        $this->orderRepository->save($model);
        $params1 = $this->getRequest()->getParams();
        $this->_redirect($params1['url']);

    }

}

