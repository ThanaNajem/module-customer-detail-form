<?php
namespace Customer\Information\Controller\Index;
class Result extends \Magento\Framework\App\Action\Action
{
	/** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

     /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customerFactory;
    /** @var \Magento\Framework\App\State **/
    private $state;
     /**      * @param \Magento\Framework\App\Action\Context $context   
			  * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory   

        */
    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory,\Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\CustomerFactory $customerFactory,\Magento\Framework\App\State $state)
    {
        $this->resultPageFactory = $resultPageFactory;
         $this->storeManager     = $storeManager;
        $this->customerFactory  = $customerFactory;
        $this->state = $state;
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
        /*start add new customer */
            try {
                      $postCustomerData = $this->getRequest()->getPostValue();
                      $fname = $postCustomerData['fname'];
                      $lname = $postCustomerData['lname'];
                      $email = $postCustomerData['email'];

                    $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_FRONTEND); // or \Magento\Framework\App\Area::AREA_ADMINHTML, depending on your needs
                    $websiteId  = $this->storeManager->getWebsite()->getWebsiteId();
                    //$this->_storeManager->getStore()->getWebsiteId();
                    // Instantiate object (this is the most important part)
                    $customer   = $this->customerFactory->create();
                    $customer->setWebsiteId($websiteId);

                    // Preparing data for new customer
                    $customer->setEmail($email); 
                    $customer->setFirstname($fname);
                    $customer->setLastname($lname);
                    $customer->setPassword("password");

                    // Save data
                    $customer->save();
                    $customer->sendNewAccountEmail();  
                    return $this->_redirect('customerInfo/index/index',['status' => "success"]);
                    } catch (Exception $e) {
                      echo $e->getMessage();
                    
                    return $this->_redirect('customerInfo/index/index',['status' => "fail"]);
                    }
                    
        /* end add new customer */
              return  $resultPage;       
         
        
    }
}