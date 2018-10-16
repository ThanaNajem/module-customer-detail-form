<?php
namespace Customer\Information\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
	/** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;
    protected $request;
     /**      * @param \Magento\Framework\App\Action\Context $context   
			  * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory   

        */
    public function __construct(\Magento\Framework\App\Action\Context $context,\Magento\Framework\App\Request\Http $request, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
         $this->request = $request;
        parent::__construct($context);
    }
      /**
     * Statistics Index, shows a list of recent Statistics products.
     *
     * @return statistics/Index/Customer
     */
    public function execute()
    {

          $resultPage = $this->resultPageFactory->create(); 
          $status = $this->request->getParam('status');
          if ($status=="success") {
             echo "customer registered successfully";
          }
          elseif ($status=="fail") {
             echo "customer don't registered successfully";
          } 
          return $resultPage;
        
    }
}