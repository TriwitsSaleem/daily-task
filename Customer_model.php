<?php 

class Customer_model extends CI_Model
{
	public function getNursery()
	{
		return $this->db->where('status',1)->get('nursery')->result();
	}

	public function registerCustomer(){
		// print_r($this->input->post());exit;
		if($this->input->post('name')){

			$checkUser = $this->db->where('aadhaar_no',$this->input->post('adhaar'))->get('customers');

			if($checkUser->num_rows() > 0){
				$checkUser = $checkUser->row();
				// $this->session->set_userdata('nursery_id',$this->input->post('nursery'));
				$this->session->set_userdata('cust_aadhaar',$this->input->post('adhaar'));
				$this->session->set_flashdata('success', 'You are Registered successfully'); // success message 'welcome back...' was changed to 'You are Registered successfully' on 05-04-2023 //
				$this->db->where('customer_aadhaar')->delete('customer_cart');
				redirect('customer-reg');//redirect of page was changed from 'customer-home' to  'customer-reg' on 05-04-2023//
			}

			$customerData = array(
				'full_name'=>$this->input->post('name'),
				'survey_number'=>$this->input->post('servey'),
				'water_source'=>$this->input->post('water'),
				'extend_of_land'=>$this->input->post('land'),
				'mobile_no'=>$this->input->post('phone'),
				'aadhaar_no'=>$this->input->post('adhaar'),
				'village'=>$this->input->post('vilage'),
				'district'=>$this->input->post('district'),
				'state'=>$this->input->post('state'),
				'taluka'=>$this->input->post('taluka'),
				'registered_date'=>date("Y-m-d H:i:s")
			);
			$this->db->insert('customers',$customerData);
			$location = array(
              'latitude'=>$this->input->post('lat'),
              'long_name'=>$this->input->post('lng'),
              'cust_id'=>$this->input->post('adhaar'),
			);
			$this->db->insert('location',$location);
			//$this->session->set_userdata('nursery_id',$this->input->post('nursery'));
			$this->session->set_userdata('cust_aadhaar',$this->input->post('adhaar'));
			$this->session->set_flashdata('success', 'You are Registered successfully'); // success message 'welcome New User...' was changed to 'You are Registered successfully' on 05-04-2023 //
			redirect('customer-reg');//redirect of page was changed from 'customer-login' to  'customer-reg' on 05-04-2023//
		}
	}

	public function getVarieties(){
		return $this->db->get('varieties')->result();
	}

    public function getVarietyByNursery($nurseryId){
		return $this->db->distinct('variety_id')->select('sapling_stock.variety_id,sapling_stock.nursery_id,varieties.*')->join('varieties','varieties.variety_id = sapling_stock.variety_id')->where('nursery_id',$nurseryId)->get('sapling_stock');
	}

	public function getSaplingsByVariety($varietyId,$nurseryId){
		return $this->db->distinct('sapling_id')->select('sapling_stock.sapling_id,sapling_stock.nursery_id,saplings.*')->join('saplings','saplings.saplingid = sapling_stock.sapling_id')->where('variety_id',$varietyId)->where('nursery_id',$nurseryId)->get('sapling_stock');
	}

	public function getNurseries(){
		return $this->db->get('nursery')->result();
	}

	public function getAvailablebagsListBySaplingAndNurseryId($saplingId,$nurseryId){
		return $this->db->distinct('sapling_stock.bag_id')->select('sapling_stock.bag_id,sapling_stock.date,bag_size.*')->order_by('date','DESC')->join('bag_size','bag_size.bag_id = sapling_stock.bag_id')->where('sapling_stock.sapling_id',$saplingId)->where('sapling_stock.nursery_id',$nurseryId)->where('closing_stock >',0)->get('sapling_stock')->result();
	}


	// public function getAvailablebagsListBySaplingAndNurseryId($saplingId){

	// 	return $this->db->select('sapling_stock.*,bag_size.bag_id,bag_size.price,bag_size.bagsize')->join('bag_size','bag_size.bag_id = sapling_stock.bag_id')->from('sapling_stock')->where('sapling_stock.sapling_id',$saplingId)->where('sapling_stock.nursery_id',$this->session->userdata('nursery_id'))->where('closing_stock >',0)->where_in('SELECT max(id) from sapling_stock group_by sapling_id')->get()->result();


	// }

	public function addToCart(){
		if($this->input->post('bag_size')){
			$checkCart = $this->db->where('customer_aadhaar',$this->session->userdata('customer_aadhaar'))->where('sapling_id',$this->input->post('sapling_id'))->where('bag_id',$this->input->post('bag_size'))->get('customer_cart');
			if($checkCart->num_rows() == 0){

				$pricePerUnit = 5;
				$bagPricePerUnit = $this->db->where('bag_id',$this->input->post('bag_size'))->get('bag_size');

				if($bagPricePerUnit->num_rows() > 0){
					$pricePerUnit = $bagPricePerUnit->row()->price;
				}

				$data = array(
					//'customer_aadhaar' => $this->session->userdata('customer_aadhaar'),
					'nursery_id' =>$this->input->post('nursery_id'),
					'sapling_id' => $this->input->post('sapling_id'),
					'bag_id' => $this->input->post('bag_size'),
					'quantity' => 1,
					'price_per_unit' => $pricePerUnit,
					'date' => date('Y-m-d H:i:s')
				);
				if($this->db->insert('customer_cart',$data)){
					$this->session->set_flashdata('added','Added sapling to cart');
					redirect('saplings-list/'.$this->input->post('variety_id').'/'.$this->input->post('nursery_id'));
				}
			}else{
				$this->session->set_flashdata('already','Already Added');
				redirect('saplings-list/'.$this->input->post('variety_id').'/'.$this->input->post('nursery_id'));
			}
		}
	}

	public function getMyCart(){
		return $this->db->select('customer_cart.*,bag_size.bag_id,bag_size.bagsize,bag_size.price,saplings.sapling')->where('customer_cart.customer_aadhaar',$this->session->userdata('cust_aadhaar'))->join('saplings','saplings.saplingid = customer_cart.sapling_id')->join('bag_size','bag_size.bag_id = customer_cart.bag_id')->get('customer_cart')->result();
	}

	public function updateCartQuantity(){
		if($this->input->post('quantity')){
			// if($this->db->set('quantity',$this->input->post('quantity'))->where('id',$this->input->post('id'))->update('customer_cart')){
			// 	print_r($this->db->last_query());exit;
			// }else{
			// 	print_r('failed');exit;
			// }
		// print_r($this->input->post('quantity'));exit;
			$availableQty = 0;
			$checkMaxQty = $this->db->order_by('date','DESC')->limit(1)->where('nursery_id',$this->input->post('nurseryId'))->where('sapling_id',$this->input->post('saplingId'))->where('bag_id',$this->input->post('bagId'))->get('sapling_stock');

			if($checkMaxQty->num_rows() > 0){
				$checkMaxQty = $checkMaxQty->row();
				if($checkMaxQty->reserved_stock == 0){
					if($this->input->post('quantity') <= $checkMaxQty->closing_stock){
						$this->db->set('quantity',$this->input->post('quantity'))->where('id',$this->input->post('id'))->update('customer_cart');
						print_r('updated');
					}else{
						print_r('failed');
					}
				}else{
					$checkMaxQtyReserved = $checkMaxQty->closing_stock - $checkMaxQty->reserved_stock;
					if($this->input->post('quantity') <= $checkMaxQtyReserved){
						$this->db->set('quantity',$this->input->post('quantity'))->where('id',$this->input->post('id'))->update('customer_cart');
						print_r('updated');
					}else{
						print_r('failed');
					}
				}
			}
		}
	}

	public function getSaplingAvailableQty($nurseryId, $saplingId, $bagId){
		$checkMaxQty = $this->db->order_by('date','DESC')->limit(1)->where('nursery_id',$nurseryId)->where('sapling_id',$saplingId)->where('bag_id',$bagId)->get('sapling_stock');
		if($checkMaxQty->num_rows() > 0){
			$checkMaxQty = $checkMaxQty->row();
			if($checkMaxQty->reserved_stock == 0){
				return $checkMaxQty->closing_stock;
			}else{
				return $checkMaxQty->closing_stock - $checkMaxQty->reserved_stock;
			}
		}else{
			return 0;
		}

	}
	public function getCartQty(){
		$cartQty=$this->db->where('customer_aadhaar',$this->session->userdata('cust_aadhaar'))->get('customer_cart');
		if($cartQty->num_rows() > 0){
			$cartQty = $cartQty->result();
			$totalQty=0;
			foreach ($cartQty as $cart) {
			   $totalQty+= $cart->quantity;
			}
			return $totalQty;
		}
	}
// public function getMaxValue($nurseryId, $saplingId, $bagId){
// 		$checkMaxQty = $this->db->order_by('date','DESC')->limit(1)->where('nursery_id',$nurseryId)->where('sapling_id',$saplingId)->where('bag_id',$bagId)->get('sapling_stock');
// 		if($checkMaxQty->num_rows() > 0){
// 			$checkMaxQty = $checkMaxQty->row();
			
// 				return $checkMaxQty->max_qty_buy;
			
// 		}else{
// 			return 0;
// 		}

// 	}
	public function getMaxValue(){
		$checkMaxQty = $this->db->get('max_qty');
		if($checkMaxQty->num_rows() > 0){
			$checkMaxQty = $checkMaxQty->row();
			
				return $checkMaxQty->max_qty;
			
		}else{
			return 0;
		}

	}
	public function confirmCustomerOrder(){
		if($this->session->userdata('cust_aadhaar')){
			$orderId = date("Y").$this->generateRandomNumbers(12);
			$cartData = $this->db->where('customer_aadhaar',$this->session->userdata('cust_aadhaar'))->get('customer_cart');
			if($cartData->num_rows() > 0){
				$cartNursery=$cartData->row();
				 $filename = '';
				  $uttara='';
				       if (!empty($_FILES['aadhaarcrad']['name'])) {
        $config['upload_path']   = './uploads/documents/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 6000;
        $config['file_name']     = $_FILES['aadhaarcrad']['name'].$orderId.$this->session->userdata('cust_aadhaar') . 'Aadhaar';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('aadhaarcrad')) {
          $error = array(
            'error' => $this->upload->display_errors()
          );
          $this->session->set_flashdata('fail', 'Something went wrong. Please upload gif | jpg | png file');
        }else{
          $data     = $this->upload->data();
          $filename = $data['file_name'];
        }
      }
      if (!empty($_FILES['uttara']['name'])) {
        $uttaraconfig['upload_path']   = './uploads/documents/';
        $uttaraconfig['allowed_types'] = 'gif|jpg|png|jpeg';
        $uttaraconfig['max_size']      = 6000;
        $uttaraconfig['file_name']     =$_FILES['uttara']['name'].$orderId.$this->session->userdata('cust_aadhaar') . 'Uttara';
        $this->load->library('upload', $uttaraconfig);
        $this->upload->initialize($uttaraconfig);
        if (!$this->upload->do_upload('uttara')) {
          $error = array(
            'error' => $this->upload->display_errors()
          );
          $this->session->set_flashdata('fail', 'Something went wrong. Please upload gif | jpg | png file');
        }else{
          $uttaradata     = $this->upload->data();
          $uttara = $uttaradata['file_name'];
        }
      }
				
				$orderedDate = date('Y-m-d H:i:s');
				$ordersData = array(
					'nursery_id' => $cartNursery->nursery_id,
					'customer_aadhaar' => $this->session->userdata('cust_aadhaar'),
					'organization' => $this->input->post('organisation'),
					'uttara' => $uttara,
					'aadhaar_card' => $filename,
					'order_id' => $orderId,
					'ordered_date' => $orderedDate,
					'payment_mode'=>$this->input->post('payment'),
				);
				
				if($this->db->insert('orders',$ordersData)){
					foreach($cartData->result() as $eachCart){
						$orderedSaplings = array(
							'order_id' => $orderId,
							'nursery_id' => $eachCart->nursery_id,
							'sapling_id' => $eachCart->sapling_id,
							'bag_id' => $eachCart->bag_id,
							'ordered_quantity' => $eachCart->quantity,
							'price_per_unit' => $eachCart->price_per_unit,
							'ordered_date' => $orderedDate
						);
						$this->db->insert('ordered_saplings',$orderedSaplings);
					}
              if($this->input->post('payment')!='Cash'){
                  $data = array(
                      'order_id'=>$orderId,
				'payment_id'=>$this->generateRandomString(16),
				'payment_mode'=>$this->input->post('payment'),
				'payment_date'=>$orderedDate,
				'pay_amount'=>$this->input->post('amount'),
			);
			$this->db->insert('payment',$data);
              }
					$this->db->where('customer_aadhaar',$this->session->userdata('cust_aadhaar'))->delete('customer_cart');
					redirect('my-orders');
				}
				
			}
		}
		
	}

public function placeOrder(){
		if($this->session->userdata('payment')){
		
			if($cartData->num_rows() > 0){
				$cartNursery=$cartData->row();
				 $filename = '';
				 
		
      if (!empty($_FILES['uttara']['name'])) {
        $uttaraconfig['upload_path']   = './uploads/documents/';
        $uttaraconfig['allowed_types'] = 'gif|jpg|png|jpeg';
        $uttaraconfig['max_size']      = 6000;
        $uttaraconfig['file_name']     =$_FILES['uttara']['name'].$orderId.$this->session->userdata('cust_aadhaar') . 'Uttara';
        $this->load->library('upload', $uttaraconfig);
        $this->upload->initialize($uttaraconfig);
        if (!$this->upload->do_upload('uttara')) {
          $error = array(
            'error' => $this->upload->display_errors()
          );
          $this->session->set_flashdata('fail', 'Something went wrong. Please upload gif | jpg | png file');
        }else{
          $uttaradata     = $this->upload->data();
          $uttara = $uttaradata['file_name'];
        }
      }
				
				$orderedDate = date('Y-m-d H:i:s');
				$data = array(
				'payment_id'=>$this->generateRandomString(16),
				'payment_mode'=>$this->input->post('payment'),
				'payment_date'=>$orderedDate,
				'pay_amount'=>$this->input->post('amount'),
			);
			$this->db->insert('payment',$data);
			$this->db->where('order_id',$this->input->post('pid'))->set('pay_status',1)->update('orders');
				
			}
		}
	}


	public function getMyOrders(){
		return $this->db->order_by('orders.id','DESC')->where('customer_aadhaar',$this->session->userdata('customer_aadhaar'))->join('nursery','nursery.nursery_id = orders.nursery_id')->get('orders')->result();
	}

	public function getOrderedSaplingsByOrderId($orderId){
		return $this->db->where('order_id',$orderId)->join('nursery','nursery.nursery_id = ordered_saplings.nursery_id')->join('saplings','saplings.saplingid = ordered_saplings.sapling_id')->join('bag_size','bag_size.bag_id = ordered_saplings.bag_id')->get('ordered_saplings')->result();
	}

public function generateRandomString($n) { 
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  $randomString = '';
  for ($i = 0; $i < $n; $i++) { 
   $index = rand(0, strlen($characters) - 1); 
   $randomString .= $characters[$index]; 
 }
 return $randomString; 
}

	public function generateRandomNumbers($n) { 
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomNumber = '';
		for ($i = 0; $i < $n; $i++) { 
			$index = rand(0, strlen($characters) - 1); 
			$randomNumber .= $characters[$index]; 
		}
		return $randomNumber; 
	}
		public function contacts()
	{
	 if($this->input->post('name')){
	 	
	 		$data = array(
	 			'name'=>$this->input->post('name'),
	 			'mobile'=>$this->input->post('mobile'),
	 			'subject'=>$this->input->post('subject'),
	 			'msg'=>$this->input->post('message'),
	 			'date'=>date('Y-m-d')
	 		);
	 		$this->db->insert('contact',$data);
	 		$this->session->set_flashdata('success', 'Message sent successfully');
          redirect(base_url());
	 	}
	}

	public function getUploads(){
		return $this->db->where('customer_aadhaar',$this->session->userdata('cust_aadhaar'))->get('upload_photos')->result();
	}
    public function getImages($id){
		return $this->db->where('uploadid',$id)->get('images')->result();
	}
	public function addmultipleimages() {

		$data = array();
      // print_r($_FILES); 
       //exit;
		if(($this->input->post('types') && $_FILES['files']['name'][0] != '')){
        // echo "string";exit;
			if($_FILES['files']['name'][0] != ''){
          // echo "string 2";exit;
				$imgUpload=$this->generateRandomString(16);
				$filesCount = count($_FILES['files']['name']);

				$dataArray =array(
							'upload_id' =>$imgUpload,
							// 'customer_aadhaar'=>$this->session->userdata('cust_aadhaar'),
							'upload_type'=>$this->input->post('types'),
							'date'=>date('Y-m-d'),
							'added_by'=>'customer',
							'msg' => ucfirst($this->input->post('msg')),
							//'nursery_id'=>$this->session->userdata('nursery_id'),
						);
						$this->db->insert('upload_photos',$dataArray);
         // print_r($filesCount);exit;
				
				for($i = 0; $i < $filesCount; $i++){
              // echo "string 3";exit;
					//print_r($filesCount);exit;
					$_FILES['file']['name']     = date('Ymdhis')."_".$this->session->userdata('cust_aadhaar')."_".$_FILES['files']['name'][$i];
					//print_r($_FILES['file']['name']);exit;
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];
            // File upload configuration
					$uploadPath = './uploads/images';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = '*';
					$config['file_name'] = date('Ymdhis')."_".$this->session->userdata('cust_aadhaar')."_".$_FILES['files']['name'][$i];
            //jpg|jpeg|png|gif|doc|docx|csv|ppt|xlsx
            // Load and initialize upload library
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
            // Upload file to server
					if($this->upload->do_upload('file')){
            // Uploaded file data
						//print_r($this->session->userdata('cust_aadhaar'));exit;
						
						$fileData = $this->upload->data();
					 $filename = $fileData['file_name'];
						//print_r($filename);exit;
						
						$dataImage = array(
                         'uploadid'=>$imgUpload,
                         'image'=> $filename,
						);
						//print_r($dataImage);exit;
						$this->db->insert('images',$dataImage);
						
						
						
					}

				}

				$this->session->set_flashdata('success', 'You have been successfully uploaded images');
						redirect('upload-images');

			}
		}
	}

	public function insertFutureDemand(){
    	if($this->input->post('year')){
    		$future = $this->generateRandomString(16);
    		$varity = $this->input->post('variety');
    		$saplings=$this->input->post('saplings');
    		$bag=$this->input->post('bagsize');
    		$qty=$this->input->post('qty');
    		$data = array(
              'future_id'=>$future,
              'customer_aadhaar'=>$this->session->userdata('customer_aadhaar'),
              'year'=>$this->input->post('year'),
              'month'=>$this->input->post('month'),
              'date'=>date('Y-m-d')
    		);
    		$this->db->insert('future_demand',$data);
    		foreach ($varity as $key => $value) {
					if($value == ''){
						continue;
					}
					$edata['future'] = $future;
					$edata['varietyid'] = $value;
					$edata['saplings_id'] = $saplings[$key];
					$edata['bag'] = $bag[$key];
					$edata['qty'] =$qty[$key];
					
					$this->db->insert('future_demand_sapling',$edata);
					
				}
				$this->session->set_flashdata('success', 'Future demand added successfully');
          redirect('future-demand');
    	}
    }

    public function getFutureDemands(){
    	return $this->db->where('customer_aadhaar',$this->session->userdata('cust_aadhaar'))->get('future_demand')->result();
    }

    public function editFutureDemand(){
    	if($this->input->post('id')){
    		$data = array(  
              'year'=>$this->input->post('year'),
              'month'=>$this->input->post('month'),

    		);
    		$this->db->where('id',$this->input->post('id'));
    		$this->db->update('future_demand',$data);
    	}
    	$this->session->set_flashdata('updated', 'Future demand updated successfully');
          redirect('view-future-demand');

    }
    public function deleteFutureDemand(){
    	if($this->input->post('did')){
    		$this->db->where('id',$this->input->post('did'))->delete('future_demand');
    		$this->session->set_flashdata('deleted', 'Future demand updated successfully');
          redirect('view-future-demand');
    	}
    }
  
    	 public function getFutureSapling($id){
    	$this->db->select('future_demand_sapling.*,varieties.variety_id,varieties.variety, saplings.saplingid,saplings.sapling,bag_size.bag_id,bag_size.bagsize,bag_size.price')
    	->from('future_demand_sapling')
    	->join('varieties','varieties.variety_id=future_demand_sapling.varietyid')
    	->join('saplings','saplings.saplingid=future_demand_sapling.saplings_id')
    	->join('bag_size','bag_size.bag_id=future_demand_sapling.bag')
    	->where('future_demand_sapling.future',$id);
        $data=$this->db->get()->result();
        //print_r($data);exit;
        return $data;
   
    }
     public function editFutureSapling($id){
    	if($this->input->post('id')){
    		$data = array(
            'varietyid'=>$this->input->post('variety'),
            'saplings_id'=>$this->input->post('saplings'),
            'bag'=>$this->input->post('bagsize'),
            'qty'=>$this->input->post('qty')
    		);
    		$this->db->where('id',$this->input->post('id'));
    		$this->db->update('future_demand_sapling',$data);
    		$this->session->set_flashdata('success', 'Future demand sapling updated successfully');
          redirect('view-future-sapling/'.$id);
    	}
    }

    public function deleteFutureSapling($id){
    	if($this->input->post('did')){
    		$this->db->where('id',$this->input->post('did'))->delete('future_demand_sapling');
    		$this->session->set_flashdata('deleted', 'Future demand sapling deleted successfully');
          redirect('view-future-sapling/'.$id);
    	}
    }
    public function getBeneficiaries(){
    	$this->db->select('orders.*,nursery.*')
    	->from('orders')
    	->join('nursery','nursery.nursery_id=orders.nursery_id')
    	->where('orders.customer_aadhaar',$this->session->userdata('cust_aadhaar'));
    	$data = $this->db->get()->result();
    	return $data;
    }
   
    public function getSapling($id){
    	$this->db->select('ordered_saplings.*,varieties.variety_id,varieties.variety, saplings.saplingid,saplings.sapling,bag_size.bag_id,bag_size.bagsize,bag_size.price')
    	->from('ordered_saplings')
    	 ->join('saplings','saplings.saplingid=ordered_saplings.sapling_id')
    	 ->join('bag_size','bag_size.bag_id=ordered_saplings.bag_id')
    	 ->join('varieties','varieties.variety_id=saplings.varityid')    	
    	 ->where('ordered_saplings.order_id',$id);
        $data=$this->db->get()->result();
       
        return $data;
    }

    public function addBenefiteMultipleimages() {

		$data = array();
      // print_r($_FILES); 
       //exit;
		if(($this->input->post('subject') && $_FILES['files']['name'][0] != '')){
        // echo "string";exit;
			if($_FILES['files']['name'][0] != ''){
          // echo "string 2";exit;
				$imgUpload=$this->generateRandomString(16);
				$filesCount = count($_FILES['files']['name']);

				$dataArray =array(
							'upload_id' =>$imgUpload,
							'customer_aadhaar'=>$this->session->userdata('cust_aadhaar'),
							'upload_type'=>'benefite',
							'subject'=>$this->input->post('subject'),
							'date'=>date('Y-m-d'),
							'added_by'=>'customer',
							'msg' => ucfirst($this->input->post('msg')),
							//'nursery_id'=>$this->session->userdata('nursery_id'),
						);
						$this->db->insert('upload_photos',$dataArray);
         // print_r($filesCount);exit;
				
				for($i = 0; $i < $filesCount; $i++){
              // echo "string 3";exit;
					//print_r($filesCount);exit;
					$_FILES['file']['name']     = date('Ymdhis')."_".$this->session->userdata('cust_aadhaar')."_".$_FILES['files']['name'][$i];
					$filesNames=date('Ymdhis')."_".$this->session->userdata('cust_aadhaar')."_".$_FILES['files']['name'][$i];
					//print_r($filesNames);exit;
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];
            // File upload configuration
					$uploadPath = './uploads/images';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = '*';
					$config['file_name'] = date('Ymdhis')."_".$this->session->userdata('cust_aadhaar')."_".$_FILES['files']['name'][$i];
					//print_r($config['file_name']);exit;
            //jpg|jpeg|png|gif|doc|docx|csv|ppt|xlsx
            // Load and initialize upload library
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
            // Upload file to server
					if($this->upload->do_upload('file')){
            // Uploaded file data
						//print_r($this->session->userdata('cust_aadhaar'));exit;
						
						$fileData = $this->upload->data();
					 $filename = $fileData['file_name'];
						//print_r($filename);exit;
						
						$dataImage = array(
                         'uploadid'=>$imgUpload,
                         'image'=> $filename,
						);
						//print_r($dataImage);exit;
						$this->db->insert('images',$dataImage);
						
						
						
					}

				}

				$this->session->set_flashdata('success', 'You have been successfully uploaded benefits');
						redirect('benefit');

			}
		}
	}
	public function getBenefitsUploads(){
		return $this->db->where('customer_aadhaar',$this->session->userdata('cust_aadhaar'))->where('upload_type','benefite')->get('upload_photos')->result();
	}

	  public function getCustomerComment($id){
    	$this->db->select('upload_photos.*,customers.aadhaar_no,customers.full_name')
    	->from('upload_photos')
    	->join('customers','upload_photos.customer_aadhaar=customers.aadhaar_no')
    	->where('upload_photos.upload_id',$id);
    	$data=$this->db->get()->row();
    	return $data;
    }
    public function getAllComments($id)
    {
    	$this->db->select('comments.*')
    	->from('comments')
    	->where('comments.upload_id',$id);
    	$data=$this->db->get()->result();
    	return $data;
    }
  public function addNewComment(){
    	if($this->input->post('id')){
    		$data = array(
            'upload_id'=>$this->input->post('id'),
            'comment'=>$this->input->post('comment'),
            'added_by'=>'Customer',
            'date'=>date('Y-m-d')
    		);
    		$this->db->insert('comments',$data);
    		$this->session->set_flashdata('success', 'Future demand sapling updated successfully');
          redirect('view-comments/'.$this->input->post('id'));
    	}
    }
	
}
?>