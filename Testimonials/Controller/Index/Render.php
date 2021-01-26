<?php

namespace Overdose\Testimonials\Controller\Index;

use Magento\Ui\Controller\Adminhtml\AbstractAction;

/**
 * Class Render
 * @package Overdose\Testimonials\Controller\Index
 */
class Render extends AbstractAction
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        if ($this->_request->getParam('namespace') === null) {
            $this->_redirect('admin/noroute');
            return;
        }
        $component = $this->factory->create($this->_request->getParam('namespace'));
        $tmp = json_decode($component->render());
        $tmp1 = [];
        foreach ($tmp as $key => $item)
        {
            if(is_array($item))
            {
                foreach ($item as $x){
                    if(is_array($x)){
                        $tmp1['items'] = $x;
                        continue;
                    }
                }
            }
            if(count($tmp1) ==2){
                continue;
            }
            $tmp1['totalRecords'] = $item;
        }
        $tmpjson = json_encode($tmp1);

        $this->_response->appendBody((string) $tmpjson);
    }
}
