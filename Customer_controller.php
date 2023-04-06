<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_controller extends CI_Controller
{
	 function __construct() {
        parent::__construct();
        if($this->session->userdata('lang') != 'KA'){
        	$_SESSION['lang'] = 'EN';
        }
    }
    
    public function index(){
    	$this->load->view('customer/web_header');
    	$this->load->view('customer/website');
    	$this->load->view('customer/web_footer');
    }
	public function customerRegistration()
	{
		// $this->load->view('customer/customer_header');
		$this->load->view('customer/web_header');
		$data['nursery']=$this->Customer_model->getNursery();
		$this->load->view('customer/customer-reg',$data);
		$this->load->view('customer/web_footer');
		// $this->load->view('customer/customer_footer');
	}
    public function loginCustomer()
    {
        // $this->load->view('customer/customer_header');
        $this->load->view('customer/web_header');
        $data['nursery']=$this->Customer_model->getNursery();
        $this->load->view('customer/login',$data);
        $this->load->view('customer/web_footer');
        // $this->load->view('customer/customer_footer');
    }
     public function contact(){
    	$this->Customer_model->contacts();
    }
// 	public function customerRegistration()
// 	{
	
// 		$data['nursery']=$this->Customer_model->getNursery();
// 		$this->load->view('customer/customer_reg',$data);

// 	}
      	//THIS FUNCTION IS USED FOR STORING LANGUAGE COOKIES
    public function cookieforLanguage(){
        $this->Cookie_model->displayCookie();
    }
	public function registerCustomer(){

		$this->Customer_model->registerCustomer();
	}
    public function loginVerify(){
        $this->Login_model->customerLogin();
    }
    public function customerLogout(){
        $this->session->unset_userdata('cust_aadhaar');
        redirect(base_url());
    }

	public function varietyList($id){

		$data['varieties'] = $this->Customer_model->getVarietyByNursery($id);
       // print_r($data['varieties']);exit;
		$data['nurseries'] = $this->Customer_model->getNurseries();
		$this->load->view('customer/customer_header');
		$this->load->view('customer/variety',$data);
		$this->load->view('customer/customer_footer');
	}
    public function homePage(){

        $this->load->view('customer/customer_header');
        $data['nursery']=$this->Customer_model->getNursery();
        $this->load->view('customer/homepage',$data);
        $this->load->view('customer/customer_footer');
    }
	public function saplingListByVarietyId($varietyId = '',$nurseryId=''){
		$data['saplings'] = $this->Customer_model->getSaplingsByVariety($varietyId,$nurseryId);
		// print_r($this->db->last_query());
		// print_r($data['saplings']->result());exit;
		$data['nurseries'] = $this->Customer_model->getNurseries();
		$this->load->view('customer/customer_header');
		$this->load->view('customer/sapling_list',$data);
		$this->load->view('customer/customer_footer');
	}

	public function addToCart(){
		$this->Customer_model->addToCart();
	}

	public function getCartDetails(){
		$data['cartProducts'] = $this->Customer_model->getMyCart();
		// print_r($data['cartProducts']);exit;
		$this->load->view('customer/customer_header');
		$this->load->view('customer/cart',$data);
		$this->load->view('customer/customer_footer');
	}

	public function updateCartQuantity(){
		$this->Customer_model->updateCartQuantity();
        //redirect('cart');
	}

	public function confirmCustomerOrder(){
		$this->Customer_model->confirmCustomerOrder();
	}
	public function getMyOrders(){
		$data['orders'] = $this->Customer_model->getMyOrders();
		// print_r($data['orders']);exit;
		$this->load->view('customer/customer_header');
		$this->load->view('customer/my_orders',$data);
		$this->load->view('customer/customer_footer');
	}

	public function getOrderedSaplingsByOrderId($orderId){
		$data['orderedSaplings'] = $this->Customer_model->getOrderedSaplingsByOrderId($orderId);
		// print_r($data['orderedSaplings']);exit;
		// print_r($this->db->last_query());exit;
		$this->load->view('customer/customer_header');
		$this->load->view('customer/ordered_saplings_list',$data);
		$this->load->view('customer/customer_footer');
	}
	 public function login(){
    	$this->load->view('customer/web_header');
    	$this->load->view('customer/login');
    	$this->load->view('customer/web_footer');
    }
    public function uploads(){

    	$this->load->view('customer/customer_header');
    	$data['uploads']=$this->Customer_model->getUploads();
    	$this->load->view('customer/uploads',$data);
    	$this->load->view('customer/customer_footer');
    }
    public function insertImages(){
    	$this->Customer_model->addmultipleimages();
    }
     public function viewImages($id){
    	
    	$this->load->view('customer/customer_header');
    	$data['images']=$this->Customer_model->getImages($id);
    	$this->load->view('customer/view_images',$data);
    	$this->load->view('customer/customer_footer');
    }
    public function futureDemand(){
    	
    	$this->load->view('customer/customer_header');
    $data['variety']=$this->Local_sale_model->getVariety();
		$data['sapling']=$this->Local_sale_model->getSaplings();
		$data['bag']=$this->Local_sale_model->getBagSzie();
    	$this->load->view('customer/future-demand',$data);
    	$this->load->view('customer/customer_footer');
    }
    public function futureDemandAdded(){
    	$this->Customer_model->insertFutureDemand();
    }
      public function viewFutureDemand(){
    	
    	$this->load->view('customer/customer_header');
        $data['future']=$this->Customer_model->getFutureDemands();
    	$this->load->view('customer/view_future_demand',$data);
    	$this->load->view('customer/customer_footer');
    }
     public function updateFutureDemandAdded(){
    	$this->Customer_model->editFutureDemand();
    }
    public function deleteFutureDemandAdded(){
    	$this->Customer_model->deleteFutureDemand();
    }
    public function viewFutureSapling($id){
    	
    	$this->load->view('customer/customer_header');
        $data['future']=$this->Customer_model->getFutureSapling($id);
         $data['variety']=$this->Local_sale_model->getVariety();
		$data['sapling']=$this->Local_sale_model->getSaplings();
		$data['bag']=$this->Local_sale_model->getBagSzie();
    	$this->load->view('customer/future_sapling',$data);
    	$this->load->view('customer/customer_footer');
    }
     public function updateSaplingFutureDemand($id){
    	$this->Customer_model->editFutureSapling($id);
    }
    public function deleteSaplingFutureDemand($id){
    	$this->Customer_model->deleteFutureSapling($id);
    }
    public function beneficiaries(){
    	
    	$this->load->view('customer/customer_header');
 
         $data['beneficiaries']=$this->Customer_model->getBeneficiaries();
		
    	$this->load->view('customer/beneficiaries',$data);
    	$this->load->view('customer/customer_footer');
    }
       public function viewBeneficiariesSapling($id){
    	
    	$this->load->view('customer/customer_header');
        $data['saplingsDetails']=$this->Customer_model->getSapling($id);
    	$this->load->view('customer/beneficiaries_saplings',$data);
    	$this->load->view('customer/customer_footer');
    }
    public function benefits(){

        $this->load->view('customer/customer_header');
        $data['uploads']=$this->Customer_model->getBenefitsUploads();
        $this->load->view('customer/benefits',$data);
        $this->load->view('customer/customer_footer');
    }
    public function uploadBenefit(){
        $this->Customer_model->addBenefiteMultipleimages();
    }
    public function viewComments($id)
    {
       
        $this->load->view('customer/customer_header');
        $data['customer']=$this->Customer_model->getCustomerComment($id);
        $data['comment']=$this->Customer_model->getAllComments($id);
        $this->load->view('customer/comments',$data);
        $this->load->view('customer/customer_footer');
    }
     public function addNewComment(){
        $this->Customer_model->addNewComment();
    }
    
    public function checkoutPage(){
		$data['cartProducts'] = $this->Customer_model->getMyCart();
		// print_r($data['cartProducts']);exit;
		$this->load->view('customer/customer_header');
		$this->load->view('customer/checkout',$data);
		$this->load->view('customer/customer_footer');
	}
}

?>