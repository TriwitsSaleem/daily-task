<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student_model extends CI_Model
{

    public function verifyScholarhipExpireStatus($expireDate)
    {
      
        
        if($expireDate!="0000-00-00" || $expireDate!="" )
        {
            
            $currentDate=date("Y-m-d");
        	$newDate = strtotime($expireDate. '+ 15 days');
			$newDate = date('Y-m-d',$newDate);
			
			if($currentDate <=$newDate){
				return true;
			}else{
				return false;
			}
			
        }
        else
        {
        return false;
        }
        
    }
    
    
  public function generateRandomString($n) 
  { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = '';
    for ($i = 0; $i < $n; $i++) { 
      $index = rand(0, strlen($characters) - 1); 
      $randomString .= $characters[$index]; 
    }
    return $randomString; 
  }

public function someOtherScholarship(){
    $query=$this->db->where('scholarship_type !=','')->where('application_end_date >=', date('Y-m-d'))->get('scholarships')->result();
    return $query;     
  }

  public function get_user_data($username,$userId)
  {
    $this->db->where('student_username',$userId);
    $this->db->where('registered_email',$username);
    $result=$this->db->get('student_registration');
    return $result;

  }
  public function returnClientIPAddress(){
    $ipAddress = getenv('HTTP_CLIENT_IP')?:
    getenv('HTTP_X_FORWARDED_FOR')?:
    getenv('HTTP_X_FORWARDED')?:
    getenv('HTTP_FORWARDED_FOR')?:
    getenv('HTTP_FORWARDED')?:
    getenv('REMOTE_ADDR');
    return ($ipAddress ) ? $ipAddress : 'not found' ;
  }


  public function studentLogin()
  {
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required|required|min_length[4]');
        // LOGIN FORM VALIDATION
    if ($this->form_validation->run() == TRUE) {
      $student = $this->db->where('registered_email', $_POST['username'])->get('student_registration');
      if ($student->num_rows() > 0) {
        $userdata = $student->row();
        if ($userdata->student_password_hashed == $_POST['password']) {
          $_SESSION['registered_email'] = $userdata->registered_email;
          $_SESSION['student_username'] = $userdata->student_username;

          $this->session->set_flashdata("success", "You are loggin in.");

          if ($this->input->get('redirect')) {
            redirect($this->input->get('redirect'));
          } else {
            redirect(base_url());
          }
                    // header('location:'.base_url().'author/dashboard');

        } else {
          $this->session->set_flashdata('Error', 'You have entered wrong password');
          redirect(base_url('student-login'));
        }
      } else {
        $this->session->set_flashdata('Error', 'No such account yet registered.');
        redirect(base_url('student-login'));
            } // End of Else
            
        } // End of IF
        
      }
      public function logindetails($username,$date)
      {
        $result=$this->db->where('student_username',$username)->where('date',$date)->get('login_details');
        return $result;
      }
      public function updateLogout()
      {
        $username=$this->session->userdata('student_username');
        $result=$this->db->set('logout_time',date("y-m-d H:i:s"))->where('student_username',$username)->where('date',date("y-m-d"))->update('login_details');
        return $result;
      }
      public function geteachRegisteredStudents()
      {
        $username = $this->session->userdata('student_username');
        $result=$this->db->where('student_username',$username)->get('student_registration')->row();
        return $result;
      }
      public function verifyisSessionExist($username)
      {
        $result = $this->db->where('student_username', $username)->get('student_personal_details');
        return $result;
      }
      public function update_personal_details()
      {
        
        $username = $this->session->userdata('student_username');
         //print_r($username);exit;
            if ($this->input->post('name')) {
                
              $data1   = array(
                'student_gender'              => $this->input->post('gender'),
                'registered_whatsapp_mobile_no'         => $this->input->post('whatsapp'),
                'course_name' => $this->input->post('qualification'),
              );
              $this->db->where('student_username',$username);
              $this->db->update('student_registration',$data1);
              $this->db->update('student_registration_log',$data1);
               $verify   = $this->verifyisSessionExist($username);
               
                if ($verify->num_rows() > 0) {
                    
              $data2   = array(
                'student_gender'              => $this->input->post('gender'),
                'student_whatsapp_no'         => $this->input->post('whatsapp'),
              );
              
             $this->db->where('student_username',$username);
              $this->db->update('student_personal_details',$data2);
               }else{
                 
                  $personalData   = array(
                'student_username'=>$username,
                'student_gender'              => $this->input->post('gender'),
                'student_whatsapp_no'         => $this->input->post('whatsapp'),
              );
              
              $this->db->insert('student_personal_details',$personalData); 
               }
                $acadmyverify   = $this->verifyisSessionExistinAcademicTable($username);
                 if ($acadmyverify->num_rows() > 0) {
                     
              $data3   = array(
                'student_current_school_name'              => $this->input->post('college'),
                'student_studying_state'         => $this->input->post('student_studying_state'),
                'student_studying_district'  => $this->input->post('student_studying_district'),
                'qualification'=> $this->input->post('qualification'),
                'current_class_or_degree'=> $this->input->post('current_class_or_degree'),
              );
              $this->db->where('student_username',$username);
              $this->db->update('student_academic_details',$data3);
                 }else{
                     
                   $acadmydata   = array(
                       'student_username'=>$username,
                'student_current_school_name'              => $this->input->post('college'),
                'student_studying_state'         => $this->input->post('student_studying_state'),
                'student_studying_district'  => $this->input->post('student_studying_district'),
                'qualification'=> $this->input->post('qualification'),
                'current_class_or_degree'=> $this->input->post('current_class_or_degree'),
              );
              $this->db->insert('student_academic_details',$acadmydata);  
                 }
                  $familyverify   = $this->verifyisSessionExistInFamilyDetailsTable($username);
                   if ($familyverify->num_rows() > 0) {
              $data4   = array(
                'family_annual_income'              => $this->input->post('family_annual_income'),
                
              );
              $this->db->where('student_username',$username);
              $this->db->update('student_family_details',$data4);
                   }else{
                     $familydata4   = array(
                          'student_username'=>$username,
                'family_annual_income'              => $this->input->post('family_annual_income'),
                
              );  
              $this->db->insert('student_family_details', $familydata4);
                   }
               // print_r($data);exit();
             
            }
          
        	redirect('scholarships');
      
      }
    public function getLinkVisitStatusList() 
{
   $username = $this->session->userdata('student_username');
  $result= $this->db->join('scholarships','scholarships.scholarship_id=sent_notifications.scholarship_id')->where('student_username',$username)->where('link_visit_status',1)->where('applied_status',0)->get("sent_notifications")->result();
  return $result;
  // print_r($result);exit();

}
      public function getRegistrationData()
      {
        $username = $this->session->userdata('student_username');
        $data = $this->db->where('student_username',$username)->get('student_personal_details')->row();
        return $data;
      }
      public function verifyisSessionExistinAcademicTable($username)
      {
        $result = $this->db->where('student_username', $username)->get('student_academic_details');
        return $result;
      }
      public function update_academic_details()
      {


        $username = $this->session->userdata('student_username');
        $verify   = $this->verifyisSessionExistinAcademicTable($username);
        if ($verify->num_rows() > 0) {

          if ($this->input->post('student_current_school_name')) {


            $stateId=$this->input->post('student_studying_state');
            $cityId=$this->input->post('student_studying_district');
            $qualification=$this->input->post('qualification');


            $stateDetails=$this->Student_model->getStateById($stateId)->row();
            $cityDetails=$this->Student_model->getCityById($cityId)->row();
            $qualificationDetail=$this->Student_model->getQUalificationById($qualification)->row();
            // print_r($qualificationDetail);exit();
            $updatesQualificationName="";
            if($qualificationDetail!='');
            {
              $updatesQualificationName=$qualificationDetail->course_name;


            }
            // print_r($updatesQualificationName);exit();

            $updateStateName="";
            $updateCityName="";

            if($stateDetails!='')
            {
              $updateStateName=$stateDetails->name;
            }

            if($cityDetails!='')
            {
              $updateCityName=$cityDetails->city;
            }
            // print_r($this->input->post('student_studying_district'));exit();

            $data   = array(
              'student_username'            => $username,
              'student_current_school_name' => $this->input->post('student_current_school_name'),
              'student_studying_state'      => $updateStateName,
              'student_studying_district'   => $this->input->post('student_studying_district'),
              'qualification'               => $updatesQualificationName,
              'current_class_or_degree'     => $this->input->post('current_class_or_degree'),
              // 'current_course'              => $this->input->post('current_course'),
              'current_semester'            => $this->input->post('current_semester'),
              'is_hosteller'                => $this->input->post('is_hosteller'),
              'tenth_board'                 => $this->input->post('tenth_board'),
              'tenth_cgpa_type'             => $this->input->post('tenth_cgpa_type'),
              'previous_year_result'        => $this->input->post('previous_year_result'),
              'tenth_cgpa_or_percentage'    => $this->input->post('tenth_cgpa_or_percentage'),
              'tenth_year_of_passing'       => $this->input->post('tenth_year_of_passing'),
              'twelfth_board'               => $this->input->post('twelfth_board'),
              'twelfth_cgpa_type'           => $this->input->post('twelfth_cgpa_type'),
              'twelfth_cgpa_or_percentage'  => $this->input->post('twelfth_cgpa_or_percentage'),
              'twelfth_year_of_passing'     => $this->input->post('twelfth_year_of_passing'),

              'diploma_board'               => $this->input->post('diploma_board'),
              'diploma_cgpa_type'           => $this->input->post('diploma_cgpa_type'),
              'diploma_cgpa_or_percentage'  => $this->input->post('diploma_cgpa_or_percentage'),
              'diploma_year_of_passing'     => $this->input->post('diploma_year_of_passing')
            );
                // print_r($data);exit();
            $result = $this->db->set($data)->where('student_username', $username)->update('student_academic_details');
            $this->session->set_flashdata('update-success', 'Your Academic Details Updated');
            return $result;
          }
        } else {

          if ($this->input->post('student_current_school_name')) {

            $stateId=$this->input->post('student_studying_state');
            $cityId=$this->input->post('student_studying_district');
            $qualification=$this->input->post('qualification');
            // print_r($qualification);exit();
            $stateDetails=$this->Student_model->getStateById($stateId)->row();
            $cityDetails=$this->Student_model->getCityById($cityId)->row();
            $qualificationDetail=$this->Student_model->getQUalificationById($qualification)->row();
             // print_r($qualificationDetail);exit();
            // $re=$qualificationDetail->course_name;

            $updatesQualificationName="";
            if($qualificationDetail!='');
            {
              $updatesQualificationName=$qualificationDetail->course_name;
            }

            $updateStateName="";
            $updateCityName="";

            if($stateDetails!='')
            {
              $updateStateName=$stateDetails->name;
            }

            if($cityDetails!='')
            {
              $updateCityName=$cityDetails->city;
            }


            $data   = array(
              'student_username'            => $username,
              'student_current_school_name' => $this->input->post('student_current_school_name'),
              'student_studying_state'      => $updateStateName,
              'student_studying_district'   => $this->input->post('student_studying_district'),
              'qualification'               => $updatesQualificationName,
              'current_class_or_degree'     => $this->input->post('current_class_or_degree'),
              'current_semester'            => $this->input->post('current_semester'),
              'is_hosteller'                => $this->input->post('is_hosteller'),
              'tenth_board'                 => $this->input->post('tenth_board'),
              'tenth_cgpa_type'             => $this->input->post('tenth_cgpa_type'),
              'previous_year_result'        => $this->input->post('previous_year_result'),
              'tenth_cgpa_or_percentage'    => $this->input->post('tenth_cgpa_or_percentage'),
              'tenth_year_of_passing'       => $this->input->post('tenth_year_of_passing'),
              'twelfth_board'               => $this->input->post('twelfth_board'),
              'twelfth_cgpa_type'           => $this->input->post('twelfth_cgpa_type'),
              'twelfth_cgpa_or_percentage'  => $this->input->post('twelfth_cgpa_or_percentage'),
              'twelfth_year_of_passing'     => $this->input->post('twelfth_year_of_passing'),
              'quota'                       => $this->input->post('quota'),
              'diploma_board'               => $this->input->post('diploma_board'),
              'diploma_cgpa_type'           => $this->input->post('diploma_cgpa_type'),
              'diploma_cgpa_or_percentage'  => $this->input->post('diploma_cgpa_or_percentage'),
              'diploma_year_of_passing'     => $this->input->post('diploma_year_of_passing')
            );
            // print_r($data);exit();
            $result = $this->db->insert('student_academic_details', $data);
            $this->session->set_flashdata('update-success', 'Your Academic Details Updated');
            return $result;
          }
        }
      }
      public function getAcademicDetails()
      {
       $username = $this->session->userdata('student_username');
       $result=$this->db->where('student_username',$username)->get('student_academic_details')->row();
       return $result;
     }
     public function getFamilyDetails()
     {
       $username = $this->session->userdata('student_username');
       $result=$this->db->where('student_username',$username)->get('student_family_details')->row();
       return $result;
     }

     public function verifyisSessionExistInFamilyDetailsTable($username)
     {
      $result = $this->db->where('student_username', $username)->get('student_family_details');
      return $result;
    }
    public function update_family_details()
    {
      $username = $this->session->userdata('student_username');

      $verify   = $this->verifyisSessionExistInFamilyDetailsTable($username);

      if ($verify->num_rows() > 0) {
        if ($this->input->post('religion')) {
          $data   = array(
            'student_username'      => $username,
            'father_fullname'       => $this->input->post('father_fullname'),
            'mother_fullname'       => $this->input->post('mother_fullname'),
            'religion'              => $this->input->post('religion'),
            'category'              => $this->input->post('category'),
            'number_of_siblings'    => $this->input->post('number_of_siblings'),
            'parent_occupation'     => $this->input->post('parent_occupation'),
            'family_annual_income'  => $this->input->post('family_annual_income'),
            'is_orphans'            => $this->input->post('is_orphans'),
            'is_single_parent'      => ($this->input->post('is_single_parent') != '')  ? $this->input->post('is_single_parent') : 0,
          );

          $result = $this->db->set($data)->where('student_username', $username)->update('student_family_details');
          $this->session->set_flashdata('update-success', 'Your Family Details Updated');
          return $result;
        }
      } else {
        if ($this->input->post('religion')) {

          $data   = array(
            'student_username'      => $username,
            'father_fullname'       => $this->input->post('father_fullname'),
            'mother_fullname'       => $this->input->post('mother_fullname'),
            'religion'              => $this->input->post('religion'),
            'is_orphans'            => $this->input->post('is_orphans'),
            'category'              => $this->input->post('category'),
            'number_of_siblings'    => $this->input->post('number_of_siblings'),
            'parent_occupation'     => $this->input->post('parent_occupation'),
            'family_annual_income'  => $this->input->post('family_annual_income'),
            'is_single_parent'      => ($this->input->post('is_single_parent') != '')  ? $this->input->post('is_single_parent') : 0,
          );
          $result = $this->db->insert('student_family_details', $data);
          $this->session->set_flashdata('update-success', 'Your Family Details Updated');
          return $result;
        }
      }
    }

    public function verifyisSessionExistInBankandAddressTable($username)
    {
      $result = $this->db->where('student_username', $username)->get('bank_and_address_details');
      return $result;
    }

    public function update_bank_address_details()
    {


      $username = $this->session->userdata('student_username');
      $verify   = $this->verifyisSessionExistInBankandAddressTable($username);
      if ($verify->num_rows() > 0) {
        if ($this->input->post('bank_beneficiary_name')) {

          $stateId=$this->input->post('student_native_state');
          $districtId=$this->input->post('student_native_district');
          $cityId=$this->input->post('student_native_city');

          $stateDetails=$this->Student_model->getStateById($stateId)->row();
          $districtDetails=$this->Student_model->getCityById($districtId)->row();
          $cityDetails=$this->Student_model->getCityById($cityId)->row();

          $updateStateName="";
          $updatedistrictName="";
          $updateCityName="";


          if($stateDetails!='')
          {
            $updateStateName=$stateDetails->name;
          }

          if($districtDetails!='')
          {
            $updatedistrictName=$districtDetails->city;
          }
          if($cityDetails!='')
          {
            $updateCityName=$cityDetails->city;
          }


          

          $data   = array(
            // 'student_username'          => $username,
            'bank_beneficiary_name'     => $this->input->post('bank_beneficiary_name'),
            'bank_account_type'         => $this->input->post('bank_account_type'),
            'bank_account_no'           => $this->input->post('bank_account_no'),
            'bank_ifsc_code'            => strtoupper($this->input->post('bank_ifsc_code')),
            'bank_branch_name'          => $this->input->post('bank_branch_name'),
            'bank_name'                => $this->input->post('bank_name'),
            'student_native_state'      => $updateStateName,
            'student_studying_state'    => $this->input->post('student_studying_state'),
            'student_native_district'   => $updatedistrictName,
            'student_studying_district' => $this->input->post('student_studying_district'),
            'student_studying_city'     => $updateCityName,
            'is_from_rural'             => $this->input->post('is_from_rural'),
          );
          // print_r($data);exit();
          $result = $this->db->set($data)->where('student_username', $username)->update('bank_and_address_details');

          return $result;
        }
      } else {
        if ($this->input->post('bank_beneficiary_name')) {


          $stateId=$this->input->post('student_native_state');
          $districtId=$this->input->post('student_native_district');
          $cityId=$this->input->post('student_native_city');

          $stateDetails=$this->Student_model->getStateById($stateId)->row();
          $districtDetails=$this->Student_model->getCityById($cityId)->row();
          $cityDetails=$this->Student_model->getCityById($cityId)->row();

          $updateStateName="";
          $updatedistrictName="";
          $updateCityName="";


          if($stateDetails!='')
          {
            $updateStateName=$stateDetails->name;
          }

          if($districtDetails!='')
          {
            $updatedistrictName=$districtDetails->city;
          }
          if($cityDetails!='')
          {
            $updateCityName=$cityDetails->city;
          }

          $data   = array(
            'student_username'          => $username,
            'bank_beneficiary_name'     => $this->input->post('bank_beneficiary_name'),
            'bank_account_type'         => $this->input->post('bank_account_type'),
            'bank_account_no'           => $this->input->post('bank_account_no'),
            'bank_ifsc_code'            => strtoupper($this->input->post('bank_ifsc_code')),
            'bank_branch_name'          => $this->input->post('bank_branch_name'),
            'bank_name'                => $this->input->post('bank_name'),
            'student_native_state'      => $updateStateName,
            'student_studying_state'    => $this->input->post('student_studying_state'),
            'student_native_district'   => $updatedistrictName,
            'student_studying_district' => $this->input->post('student_studying_district'),
            'student_studying_city'     => $updateCityName,
            'is_from_rural'             => $this->input->post('is_from_rural'),
          );
                // print_r($data);exit();
          $result = $this->db->insert('bank_and_address_details', $data);
          $this->session->set_flashdata('bank-details-update-success', 'Your Bank and Address Details Updated');
          return $result;
        }

      }


    }

    public function getBankandAddressDetails()
    {
     $username = $this->session->userdata('student_username');
     $result=$this->db->where('student_username',$username)->get('bank_and_address_details')->row();
     return $result;
   }

   public function add_document_files()
   {
     $username = $this->session->userdata('student_username');
     if ($this->input->post('document_type')) {
       $data   = array(
        'student_username'      => $username,
        'document_type'         => $this->input->post('document_type'),
        'semester'              => $this->input->post('semester'),
        'document_files_links'  => $this->input->post('document_files_links'),
      );
       // print_r($data);exit();
       $result=$this->db->insert('documents_files',$data);
       $this->session->set_flashdata('add-success', 'Your Document Files Updated');
       return $result;
     }
   }
   public function verifyisSessionExistInDocumentDetailsTable($username)
   {
    $result = $this->db->where('student_username', $username)->get('documents_files');
    return $result;
  }

  public function update_document_files()
  {
    $username = $this->session->userdata('student_username');
    $verify   = $this->verifyisSessionExistInDocumentDetailsTable($username);
    if ($verify->num_rows() > 0) {
      if ($this->input->post('document_type')) {
        $data   = array(
          'student_username'      => $username,
          'document_type'         => $this->input->post('document_type'),
          'semester'              => $this->input->post('semester'),
          'document_files_links'  => $this->input->post('edocument_files_links'),
        );
                // print_r($data);exit();
        $result = $this->db->set($data)->where('student_username', $username)->update('documents_files');
        $this->session->set_flashdata('update-success', 'Your Document Files Updated');
        return $result;
      }
    } else {
      if ($this->input->post('document_type')) {
       $data   = array(
        'student_username'      => $username,
        'document_type'         => $this->input->post('document_type'),
        'semester'              => $this->input->post('semester'),
        'document_files_links'  => $this->input->post('document_files_links'),
      );
        // print_r($data);exit();
       $result = $this->db->insert('documents_files', $data);
       $this->session->set_flashdata('update-success', 'Your Document Files Updated');
       return $result;
     }
   }
 }

 public function getDocumentFilesDetails($username)
 {
  $result=$this->db->where('student_username',$username)->get('documents_files')->result();
  return $result;
}



public function updateEachDocumentsDetails($id)
{
  if($this->input->post('edocument_files_links'))
  {
   $data   = array(

    'document_files_links'  => $this->input->post('edocument_files_links'),
  );
     // print_r($data);exit();
   $result=$this->db->set($data)->where('id',$id)->update('documents_files');
   $this->session->set_flashdata('update-success', 'Your Document Files Updated');
   redirect('document_uploads');
 }
 
 return $result;
}


public function getActivityTypes()
{
  $result=$this->db->distinct('student_activity_type_id')->select('student_activity_type_id')->get('student_activity_name')->result();
  return $result;
}


public function getStudentSportsActivityName()
{
  $result=$this->db->get('student_activity_name')->result();
  return $result;
}
  //   public function getStudentHobbiesActivityName()
  // {
  //   $result=$this->db->join('student_activity','student_activity.id=student_activity_name.student_activity_type_id')->where('activity_type',"Sports")->get('student_activity_name')->result();
  //   return $result;
  // }  
public function add_extracurricular_activity()
{
 $username = $this->session->userdata('student_username');
 $studentAactivity =$this->input->post('student_activity_name');
 $studentAchievement = $this->input->post('student_activity_achievement');
 $activity_type = $this->input->post('activity_type');

 foreach ($studentAactivity as $key => $value) {
  if($value == ''){
    continue;
  }
  // $data['items'] = $value;
  $data['student_username '] = $username;
  $data['student_activity_name'] = $studentAactivity[$key];
  $data['student_activity_achievement'] = $studentAchievement[$key];
  // print_r($data);exit();
  $result=$this->db->insert('student_extracarricular_details',$data);
  $this->session->set_flashdata('add-success', 'Your Extracurricular Added');

}
}

public function getExtracurricularActivity()
{
  $username = $this->session->userdata('student_username');
  $data=$this->db->where('student_username',$username)->get('student_extracarricular_details')->result();
  return$data;
}
public function update_extracurricular_activity($id)
{
  if($this->input->post('estudent_activity_name'))
  {
    $data= array(
      'student_activity_name' => $this->input->post('estudent_activity_name'), 
      'student_activity_achievement'=>$this->input->post('estudent_activity_achievement')
    );
    // print_r($data);exit();
    $result=$this->db->set($data)->where('id',$id)->update('student_extracarricular_details');
    $this->session->set_flashdata('activity-update', 'Your Extracurricular Added');
    redirect('extracurricular_details');
  }
}

//  public function addContactUs()
// {
//   if($this->input->post('name'))
//   {
//     $username = $this->session->userdata('student_username');
//     $data=array(
//       'student_username'=>$username,
//       'name'=>ucfirst($this->input->post('name')),
//       'number'=>$this->input->post('number'),
//       'message'=>ucfirst($this->input->post('message')),
//       'requested_date'=>date('Y-m-d H-i-sA'),
//       'status'=>0
//     );
    
//     $result=$this->db->insert('contact_us',$data);
//     $this->session->set_flashdata('update-success', 'Your  Message successfully Sent');
//   }
// }

public function addContactUs()
{
  if($this->input->post('message'))
  {
    $username = $this->session->userdata('student_username');

    $studentName='';
    $studentNumber='';


    $studentDetails=$this->db->where('student_username',$username)->get('student_registration')->row();

    if($studentDetails!='')
    {
       $studentName=$studentDetails->student_name;
      $studentNumber=$studentDetails->registered_mobile_no;
    }



    $data=array(
      'student_username'=>$username,
      'name'=>ucfirst($studentName),
      'number'=> $studentNumber,
      'message'=>ucfirst($this->input->post('message')),
      'requested_date'=>date('Y-m-d H-i-sA'),
      'status'=>0
    );
    // print_r($data);exit();
    $result=$this->db->insert('contact_us',$data);
    $this->session->set_flashdata('update-success', 'Your  Message successfully Sent');
    redirect('need-help');
  }
  else
  {
     $this->session->set_flashdata('update-error', 'Please enter the message');
     redirect('need-help');
  }
}


public function get_latest_feed_back()
{
  $email=$this->session->userdata('registered_email');
  $studentId=$this->session->userdata('student_username');

  return   $this->db->query("select * from feed_back where student_email='$email' and  student_id='$studentId' order by feed_back_id desc limit 1")->row();



}
public function get_profile_photo()
{
  $studentId=$this->session->userdata('student_username');
  $data=$this->db->where('student_username',$studentId)->get('student_personal_details')->row();
  return $data;
}

public function getStudentDetailsByRegisteredEmail($studentEmail)
{
  $this->db->where('registered_email',$studentEmail);
  $result=$this->db->get('student_registration');
  return $result;
}


public function getStateList()
{

  $result=$this->db->query("select * from  states order by name asc");
  // $result=$this->db->get('states');
  return $result;
}

public function getAllList()
{

  $result=$this->db->query("select * from cities order by city asc ");
  // $this->db->where('state_id',$id);
  // $result=$this->db->get('cities');
  return $result;

}
public function getCitiesList($id)
{

  $result=$this->db->query("select * from cities where state_id='$id' order by city asc ");
  // $this->db->where('state_id',$id);
  // $result=$this->db->get('cities');
  return $result;

}
public function getCourse()
{

  $result=$this->db->query("select * from  courses order by id asc");
  // $this->db->select('*')->from('courses')->get()->result();
  // print_r($result);exit()
  // $result=$this->db->get('states');
  return $result;
}
public function getParticularCourse($id)
{

  // print_r("in");exit;

   // $result=$this->db->query("select * from course_particulars where course_id='$id' order by particular_name asc ");
  $result=$this->db->select('*')->from('course_particulars')->where('course_id',$id)->get();
  // $this->db->where('state_id',$id);
  // $result=$this->db->get('cities');
  return $result;

}



public function getStateById($stateId)
{

  $result=$this->db->query("select * from  states where id='$stateId' order by name asc");

  // $this->db->where('id',$stateId);
  // $result=$this->db->get('states');
  return $result;

}
public function getQUalificationById($qualification)
{
  // print_r($qualification);exit();
  $result=$this->db->query("select * from  courses where id='$qualification' order by id asc");

  // $this->db->where('id',$stateId);
  // $result=$this->db->get('states');
  return $result;

}

public function getCityById($cityId)
{

  $result=$this->db->query("select * from cities where id='$cityId' order by city asc ");

  // $this->db->where('id',$cityId);
  // $result=$this->db->get('cities');
  return $result;
}
public function getScholarshipNotifcation($limit,$start)
{
  $this->db->limit($limit, $start);
  $username = $this->session->userdata('student_username');
  $result=$this->db->where('student_username',$username)->join('scholarships','scholarships.scholarship_id=sent_notifications.scholarship_id')->order_by('sent_notifications.date_time','desc')->get('sent_notifications');
  return $result->result();
}
public function getAllScholarship($limit,$start)
{
//   $this->db->limit($limit, $start);
  $result = $this->db->select('*')->where('application_end_date >=',date('Y-m-d'))->order_by("application_end_date", "asc")->from('scholarships')->get();
  return $result->result();
}
public function getByTypeScholarship($id)
{
//   $this->db->limit($limit, $start);
$string = str_replace('%20', ' ', $id);
  $result = $this->db->select('*')->where('scholarship_type',$string)->where('application_end_date >=',date('Y-m-d'))->order_by("application_end_date", "asc")->from('scholarships')->get();
  return $result->result();
}
public function get_count() 
{
   $username = $this->session->userdata('student_username');
  return $this->db->where('student_username',$username)->get("sent_notifications")->num_rows();

}

// public function getScholarshipDetails()
// {
//  $username = $this->session->userdata('student_username');
//  $result=$this->db->where('student_username',$username)->join('scholarship_attachment','scholarship_attachment.scholarship_id=sent_notifications.scholarship_id')->join('scholarships','scholarships.scholarship_id=sent_notifications.scholarship_id')->get('sent_notifications')->row();
//  return $result;

// }

public function getScholarshipDetails($id)
{
 $username = $this->session->userdata('student_username');
 $result=$this->db->where('student_username',$username)->where('scholarships.scholarship_id',$id)->join('scholarships','scholarships.scholarship_id=sent_notifications.scholarship_id')->get('sent_notifications')->row();
 return $result;

}
public function getAttachment($id)
{

  $result=$this->db->where('scholarship_id',$id)->get('scholarship_attachment')->result();
  return $result;

}

public function getParentOccupation()
{


  $result=$this->db->get('parent_occupations');
  return $result;

}


public function verifyMobileNumber($mobileNumber)
{
  $zero='0';
  $this->db->where('registered_mobile_no',$mobileNumber);
  $this->db->where('registration_status',$zero);
  $result=$this->db->get('student_registration_log');

  if($result->num_rows()>0)
  {
    $this->db->set('referral_code','');
    $this->db->where('registered_mobile_no',$mobileNumber);
    $this->db->update('student_registration_log');
    return true;
  }
  else
  {
    return false;
  }

}




public function verifyMobileNumberInRegistrationTable($mobileNumber)
{

  $this->db->where('registered_mobile_no',$mobileNumber);
  $result=$this->db->get('student_registration');

  if($result->num_rows()>0)
  {
    return true;
  }
  else
  {
    return false;
  }

}



public function verifyAlreadyRegistered($mobileNumber)
{


  $zero='1';
  $this->db->where('registered_mobile_no',$mobileNumber);
  $this->db->where('registration_status',$zero);
  $result=$this->db->get('student_registration_log');

  if($result->num_rows()>0)
  {
    return true;
  }
  else
  {
    return false;
  }
}




public function verifyStudentEmailInRegistrationTable($email)
{

  $this->db->where('registered_email',$email);
  $result=$this->db->get('student_registration');

  if($result->num_rows()>0)
  {
    return true;
  }
  else
  {
    return false;
  }
}


public function verifyStudentEmail($email)
{
 $zero='1';
 $this->db->where('registered_email',$email);
 $this->db->where('registration_status',$zero);
 $result=$this->db->get('student_registration_log');

 if($result->num_rows()>0)
 {
  return true;
}
else
{
  return false;
}

}


public function getStudentDetailByMobileNumber($mobileNumber)
{

  $this->db->where('registered_mobile_no',$mobileNumber);
  $result=$this->db->get('student_registration_log');
  return $result;
}

public function addStudentRegistrationDetails($data)
{

  $result=$this->db->insert('student_registration_log',$data);
  return $result;
}
public function getStudentDetailsForUpdate($student_id)
{

  $this->db->where('student_username',$student_id);
  $result=$this->db->get('student_registration_log');
  return $result;

}
public function getStudentDetailsForRenewal($student_id)
{

  $this->db->where('student_username',$student_id);
  $result=$this->db->get('student_registration');
  return $result;

}

public function updateStudentRegistrationDetails($data,$id,$mobileNumber)
{

  $this->db->set($data);
  $this->db->where('id',$id);
  $this->db->where('registered_mobile_no',$mobileNumber);
  $result=$this->db->update('student_registration_log',$data);

  return $result;
}

public function insertActualStudentRegistrationDetails($data)
{
  $result=$this->db->insert('student_registration',$data);
  return $result;
}


public function getCouresList()
{

  $result=$this->db->query("select * from courses order by id asc");
  return $result;
}

public function getCourseDetailsById($id)
{
  $this->db->where('id',$id);
  $result=$this->db->get('courses');
  return $result;
}

public function getStudentDetailByStudentId($id)
{

  $this->db->where('student_username',$id);
  $result=$this->db->get('student_registration_log');
  return $result;


}
public function getDisabilityType()
{
  $result=$this->db->get('disability_type');
  return $result;


}

public function getSubscriptionPakages()
{
  $result=$this->db->get('subscription_packages')->row();
  return $result;


}
public function getSubscriptionAmount($id)
{
  $result=$this->db->where('id',$id)->get('subscription_packages')->row();
  return $result;


}
public function getSpecificEachReferralCode()
{
  $username = $this->session->userdata('student_username');
  $referrals=$this->geteachRegisteredStudents();

  $result=$this->db->where('student_username',$username)->get('referral_codes')->row();
  //print_r($result);exit;
  
  return $result;
}
public function getEachReferralCode()
{
  $username = $this->session->userdata('student_username');
  $referrals=$this->geteachRegisteredStudents();

  $result=$this->db->where('student_username',$username)->get('referral_codes')->row();
  //print_r($result);exit;
  $data=$this->db->where('referral_code',$result->referral_code)->get('student_registration');
  //print_r($data);exit;
  return $data;
}

public function countEachRefferal()
{
 $username = $this->session->userdata('student_username');
 $refferals=$this->getSpecificEachReferralCode();
 if($refferals != ''){
   $refer=$refferals->referral_code;
 }else{
  $refer='-';
}

$result = $this->db->where('referral_code',$refer)->get('referral_logs')->num_rows();
return $result;
}


public function referralOffers()
{
  $result = $this->db->get('referral_offers')->row();
  return $result;
}
public function getRefferalOffers()
{
  $username = $this->session->userdata('student_username');
  // $referralOffers=$this->referralOffers();
  // $eachRefer=$referralOffers->earn_on_referral;
  // $discount_on_referral=$referralOffers->discount_on_referral;
  // $start_datetime=$referralOffers->start_datetime; 
  // $end_datetime=$referralOffers->end_datetime;

  $refferals=$this->getSpecificEachReferralCode();
  if($refferals != ''){
   $refer=$refferals->referral_code;
 }else{
  $refer='-';
}


$result = $this->db->select_sum('earned_on_referral_amount')->where('referral_code',$refer)->get('referral_logs')->row();
return $result;
}
public function getRefferalOffersforShare()
{
  $result = $this->db->where('id',1)->get('referral_offers')->row();
  return $result;
}
public function verifyrefferal($code)
{
  $result=$this->db->where('referral_code',$code)->where('referral_code_status',1)->get('referral_codes');
  $refferalOffers=$this->db->where('id',1)->get('referral_offers')->row();
  $discount=$refferalOffers->discount_on_referral;
  $earnOnRefferal=$refferalOffers->earn_on_referral;
  if($result->num_rows()>0)
  {
    $subscription_packages=$this->db->where('id',1)->get('subscription_packages')->row();
    $amount=$subscription_packages->amount;
    $totalamount = $amount-$discount;
    return  $totalamount;
  }
  else
  {
    return ;
  }
}
public function isValidReferralCode($referral_code){
 $result=$this->db->where('referral_code',$referral_code)->where('referral_code_status',1)->get('referral_codes');
 if($result->num_rows() > 0){
  return true;
}else{
  return false;
}
}

public function isValidDiscountCode($discountode){
 return $this->db->where('discount_code',$discountode)->where('status',1)->get('sales_discount_code');

}

public function isValidSalesReferralCode($referral_code){
 $result=$this->db->where('discount_code',$referral_code)->where('status',1)->get('sales_discount_code');
 if($result->num_rows() > 0){
  return true;
}else{
  return false;
}
}


public function getReferralOffersById($id){
  return $this->db->where('id',$id)->get('referral_offers');
}

public function getSubscriptionAmtBySubcriptionId($id){
  
  return $this->db->where('id',$id)->get('subscription_packages');
}
public function getSalesDiscountOffersById($id){

  return $this->db->where('discount_code',$id)->get('sales_discount_code');
}


public function scholarshipAppliedStatus()
{

  $username = $this->session->userdata('student_username');
  $scholarshipId = $this->input->post('scholarshipId');
  $scholarship=$this->input->post('name');
  // print_r($scholarship);exit();
  if($scholarship!=''){
  foreach ($scholarship as $eachscholarship) {
   $this->db->where('student_username',$username)->where('scholarship_id',$eachscholarship)->set('applied_status',1)->update('sent_notifications');
  }
  // $result=$this->db->where('student_username',$username)->where('scholarship_id',$scholarshipId)->set('applied_status',1)->update('sent_notifications');
  // return $result;
}
}
public function scholarshipReceivedStatus()
{
  $username = $this->session->userdata('student_username');
  $scholarshipId = $this->input->post('scholarshipId');
  $result=$this->db->where('student_username',$username)->where('reward_received_status',$scholarshipId)->set('reward_received_status',1)->update('sent_notifications');
  return $result;
}

public function totalWorth(){
  $this->db->select('s.*,sn.*');
  $this->db->from('scholarships s');
  $this->db->join('sent_notifications sn','sn.scholarship_id=s.scholarship_id');
  $this->db->where('sn.student_username',$this->session->userdata('student_username'));
  $data = $this->db->get()->result();
  return $data;
} 

public function totalAppliedWorth(){
  $this->db->select('s.*,sn.*');
  $this->db->from('scholarships s');
  $this->db->join('sent_notifications sn','sn.scholarship_id=s.scholarship_id');
  $this->db->where('sn.applied_status',1);
  $this->db->where('sn.student_username',$this->session->userdata('student_username'));
  $data = $this->db->get()->result();
  return $data;
}

public function totalMissedWorth(){
  $this->db->select('s.*,sn.*');
  $this->db->from('scholarships s');
  $this->db->join('sent_notifications sn','sn.scholarship_id=s.scholarship_id');
  $this->db->where('sn.applied_status',0);
  $this->db->where('sn.student_username',$this->session->userdata('student_username'));
  $data = $this->db->get()->result();
  return $data;
}

public function totalReceivedWorth(){
  $this->db->select('s.*,sn.*');
  $this->db->from('scholarships s');
  $this->db->join('sent_notifications sn','sn.scholarship_id=s.scholarship_id');
  $this->db->where('sn.reward_received_status',1);
  $this->db->where('sn.student_username',$this->session->userdata('student_username'));
  $data = $this->db->get()->result();
  return $data;
}
public  function moneyFormatIndia($num) {
  $explrestunits = "" ;
  if(strlen($num)>3) {
    $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
          if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
              } else {
                $explrestunits .= $expunit[$i].",";
              }
            }
            $thecash = $explrestunits.$lastthree;
          } else {
            $thecash = $num;
          }
    return $thecash; // writes the final format where $currency is the currency symbol.
  }


  public function getInvoice(){
    $this->db->select('*')->from('invoice')->where('student_id',$this->session->userdata('student_username'));
    $data = $this->db->get();
//print_r($data);exit;
    return $data;
  }
  public function invoiceDetail($id){
    $this->db->select('invoice.*,student_registration.student_username,student_registration.student_name,
      student_registration.registered_email,student_registration.registered_mobile_no,student_registration.student_state')
    ->from('invoice')->join('student_registration','student_registration.student_username=invoice.student_id')->where('invoice.invoice_id',$id);
    $data = $this->db->get()->row();
//print_r($data);exit;

    return $data;
  }

  public function alreadyPromotions($mobileNumber)
  {

   $this->db->where('registered_mobile_no',$mobileNumber);
   $result=$this->db->get('free_trial');
   return $result;
 }

 public function verifyPromotionEmail($email)
 {
   $zero='1';
   $this->db->where('registered_email',$email);
   $this->db->where('registration_status',$zero);
   $result=$this->db->get('free_trial');

   if($result->num_rows()>0)
   {
    return true;
  }
  else
  {
    return false;
  }


}

public function promotionMobile($mobileNumber)
{ 

	$zero='0';
	$this->db->where('registered_mobile_no',$mobileNumber);
	$this->db->where('registration_status',$zero);
	$result=$this->db->get('free_trial');

	if($result->num_rows()>0)
	{
		return true;
	}
	else
	{
		return false;
	}


}

public function alreadyMobile($mobileNumber)
{

	$zero='1';
	$this->db->where('registered_mobile_no',$mobileNumber);
	$this->db->where('registration_status',$zero);
	$result=$this->db->get('free_trial');

	if($result->num_rows()>0)
	{
		return true;
	}
	else
	{
		return false;
	}

}

public function addPromotionRegistration()
{
  $mobile_number=$this->promotionMobile($this->input->post('mobile_number'));
  $registered=$this->alreadyMobile($this->input->post('mobile_number'));
   $source=$this->input->post('page_source');

  //$courseDetails=$this->Student_model->getCourseDetailsById($this->input->post('course'))->row();


  if($registered)
  { 
    $this->session->set_flashdata("account-already-exists","Already registered");
    redirect('free-trail-register');
  }
  else if($mobile_number)
  {   
    $data=$this->alreadyPromotions($this->input->post('mobile_number'))->row();
    $this->session->set_flashdata("continue-registration","welcome back, please continue your registration");
    $studentId=$data->student_username;
    redirect("trail-student-account/$studentId");
  }
  else
  {
    $studentId=$this->Student_model->generateRandomString(18);
    $data=array(

     'student_username'=>$studentId, 
     'student_name'=>ucfirst($this->input->post('fullname')),
     'registered_mobile_no'=>$this->input->post('mobile_number'),
     'student_state'=>$this->input->post('state'),
     'course_name'=>$this->input->post('course'),
      'source'=>$source,
     'registration_status'=>0,
     'registration_initiated_datetime'=>date('Y-m-d H:i:s'),

   );

    $result = $this->db->insert('free_trial',$data);
    if($result)
    {


     redirect('trail-student-account/'.$studentId);
   }
   else
   {
     $this->session->set_flashdata("add-student-registration-failure","Failed to add your  details");
     redirect('free-trail-register');
   }

 }


}

public function getTrial(){
  return $this->db->get('trial_period')->row();
}
public function getPromotionalDetailsForUpdate($student_id)
{


	$this->db->where('student_username',$student_id);
	$result=$this->db->get('free_trial');
	return $result;


}
public function addPromotionAccount($id)
{ 
  //print_r($id);exit;
  $studentId=$this->input->post('uniqueNumber');
  $subscriptionId=$this->input->post('payable_amount');
  // $subscriptionPackage=$this->Student_model->getSubscriptionAmount($subscriptionId);
  // print_r($subscriptionPackage);exit();

  $verifyStudentEmail=$this->verifyPromotionEmail($this->input->post('email'));
  if($verifyStudentEmail)
  {
    $this->session->set_flashdata("email-already-exists","Account already registered with this email, please use different email,");
    redirect("trail-student-account/$studentId");
  }
  $studentDetails=$this->getPromotionalDetailsForUpdate($id)->row();

 // print_r($studentDetails);exit;
  $tid="";
  $mobileNumber="";
  if($studentDetails!='')
  {
    $tid=$studentDetails->id;
    $mobileNumber=$studentDetails->registered_mobile_no;
  }
  // $subscriptionAmount="";
  // if($subscriptionPackage!='')
  // {
  //  $subscriptionAmount=$subscriptionPackage->amount;
 //            // print_r( $subscriptionAmount);exit();
  // }

  // $rcode=$this->input->post('referal_code');
  $day =$this->getTrial();
  $expireDate = date('Y-m-d', strtotime("+$day->period days"));
 // print_r($expireDate);exit;
  $data=array(
    'registered_email'=>$this->input->post('email'),
    'registered_whatsapp_mobile_no'=>$this->input->post('mobile_number'),
    'student_password_hashed'=>$this->input->post('confirm_password'),
    'registration_status'=>1,
    'subscription_validity_datetime'=>$expireDate
    //'referral_code'=>$this->input->post('referal_code'),
  );
  //print_r($data);exit;
  $this->db->set($data);
  $this->db->where('student_username',$id);
  //$this->db->where('registered_mobile_no',$mobileNumber);

  $result=$this->db->update('free_trial',$data);

  // $this->db->trans_start();
  
  // $this->db->trans_complete();


  if ($result)
  {
    $refCode =$this->Promotion_model->generateRandomString(11);
    $studlog = array(
     'student_username'=>$id,
     'student_name'=>$this->input->post('email'),
     'registered_email'=>$studentDetails->registered_email,
     'student_password_hashed'=>$this->input->post('mobile_number'),
     'registered_mobile_no'=>$studentDetails->registered_mobile_no,
     'registered_whatsapp_mobile_no'=>$this->input->post('mobile_number'),
     'student_state'=>$studentDetails->student_state,
     'course_name'=>$studentDetails->course_name,
     'registration_initiated_datetime'=>$studentDetails->registration_initiated_datetime,
     'subscription_validity_datetime'=>$expireDate,
     'is_trial_register'=>1,
     'page_source'=>$studentDetails->source,
     'referral_code'=> $refCode,      

   );



    $this->db->insert('student_registration_log',$studlog);

    $studeReg = array(
     'student_username'=>$id,
     'student_name'=>$studentDetails->student_name,
     'registered_email'=>$this->input->post('email'),
     'student_password_hashed'=>$this->input->post('mobile_number'),
     'registered_mobile_no'=>$studentDetails->registered_mobile_no,
     'registered_whatsapp_mobile_no'=>$this->input->post('mobile_number'),
     'student_state'=>$studentDetails->student_state,
     'course_name'=>$studentDetails->course_name,
     'registration_datetime'=>$studentDetails->registration_initiated_datetime,
     'subscription_validity_datetime'=>$expireDate,
     'referral_code'=> $refCode,
     'is_trial_register'=>1,
     'registration_status'=>1
   );
  // print_r($studeReg);exit;
    $this->db->insert('student_registration',$studeReg);

    redirect(base_url('student-login'));
  }
  else
  {
    $this->session->set_flashdata('update-student-registration-failure','Registration failure');
    redirect("trail-student-account/$studentId");
  }

}
public function getAlertNotification()
{
  $result=$this->db->limit(4)->order_by('added_date','desc')->get('alert_notifications')->result();
  return $result;
}

public function getLoginDetails()
{
  $username=$this->session->userdata('student_username');
  $result=$this->db->where('student_username',$username)->order_by('date','desc')->limit(1)->get('login_details')->result();
  return $result;
}
public function getHistoryDetails()
{
  $username=$this->session->userdata('student_username');
  $result=$this->db->where('student_username',$username)->order_by('date','desc')->get('login_details')->result();
  return $result;
}
public function getRegDateByUserId(){
  $data = $this->db->where('student_username',$this->session->userdata('student_username'))->get('student_registration')->row();
  return $data;

}





public function getWebinarLinksByWebinarName($webinarName){
       // return $this->db->join('webinars','webinars.webinar_id = webinar_links.webinar_id')->where('webinar_name',$webinarName)->get('webinar_links');


  $result=$this->db->query("select * from webinar_registration join generate_links on  generate_links.webinar_id=webinar_registration.webinar_uniqueid join links on links.generate_links_id=generate_links.institutional_link_id 

    where generate_links.webinar_name='$webinarName'


    ");

  return $result;


}


public function supportWebinarRegistration(){
  if($this->input->post('number')){
    $existence = $this->db->where('mobile_no',$this->input->post('number'))->get('students_webinar_registration');
    if($existence->num_rows() > 0){
      $_SESSION['user_added_allow_qr_and_link'] = 'true';
      redirect('web/'.$this->input->post('segment_name'));
    }else{
      $dataArray = array(
        'mobile_no' => $this->input->post('number'),
        'email' => $this->input->post('email'),
        'full_name' => $this->input->post('fname'),
        'class' => $this->input->post('degree'),
        'webinar_name' => $this->input->post('segment_name'),
        'registered_date'=>date('Y-m-d H:i:s')
      );
      //print_r($dataArray);exit;
      $this->db->insert('students_webinar_registration',$dataArray);
      $_SESSION['user_added_allow_qr_and_link'] = 'true';
    }
    redirect('web/'.$this->input->post('segment_name'));
  }
}

public function subscriptionDateExpired()
{
  $username=$this->session->userdata('student_username');
  return $this->db->where('student_username',$username)->where('subscription_validity_datetime <=',date('y-m-d'))->get('student_registration');
}
public function getbackbuttonredirection($id)
{
  $backUrl = base_url();
  $result=$this->db->where('child_uri',$id)->get('backbuttonredirection');
  if($result->num_rows() > 0 ){
   $backUrl = $result->row()->parent_uri;
 }

 return $backUrl;
}

public function subscriptionPackages()
{
  return $this->db->get('subscription_packages')->result();
}
public function emailInvoiceDetails()
{

    $this->db->select('invoice.*,student_registration.student_username,student_registration.student_name,
      student_registration.registered_email,student_registration.registered_mobile_no,student_registration.student_state')
    ->from('invoice')->join('student_registration','student_registration.student_username=invoice.student_id')->where('invoice.invoice_id',$id);
    $data = $this->db->get()->row();
//print_r($data);exit;

    return $data;
}


public function getFinalAmountToBePaid(){
    
}

public function getResponse()
{
  $username=$this->session->userdata('student_username');
  $this->db->where('student_username',$username);
  $result=$this->db->get('contact_us');
  return $result;
}


public function feedBackVerification($studentId)
{
  $this->db->where('student_id',$studentId);
  $result=$this->db->get('feed_back');

  if($result->num_rows()>0)
  {
    return true;

  }
  else
  {
    return false;
  }
}
public function getRedeemLogs()
{
   $username=$this->session->userdata('student_username');

   return $this->db->where('student_username',$username)->get('redeem_logs');
}
public function verifyMobile($mobile)
{
  return $this->db->where('registered_mobile_no',$mobile)->get('student_registration');

}
public function verifyEmail($email)
{
  return $this->db->where('registered_email',$email)->get('student_registration');
}
public function redeemRequest()
{
 
  
 $username=$this->session->userdata('student_username');

 $mobile=$this->input->post('mobile_number');
 $email=$this->input->post('registered_email');
 $verifyMobile=$this->verifyMobile($mobile);
 $verifyEmail=$this->verifyEmail($email);
 if($verifyMobile->num_rows()>0)
 {
  $this->session->set_flashdata("number-exist","congrats");
  redirect('earn-money-refer-friend');
 }
 else if($verifyEmail->num_rows()>0)
 {
 $this->session->set_flashdata("email-exist","congrats");
 redirect('earn-money-refer-friend');
 }
else
{
    if($username)
  {
    $redeemID=$this->generateRandomString(18);
    $data=array(

      'redeem_request_id'=>$redeemID,
      'student_username'=>$username,
      'redeem_option'=>$this->input->post('redeem_option'),
      'request_solved_status'=>0,
      'request_date'=>date('y-m-d H:i:s'),
      'bhim_upi_id'=>$this->input->post('bhim_upi_id'),
      'redeem_amount'=>$this->input->post('redeem_amount')
    );
    // print_r($data);exit();
    $result=$this->db->insert('redeem_request',$data);

    if($result)
    {
       $redeemLogs=array(
      'redeem_request_id'=>$redeemID,
      'student_username'=>$username,
      'status'=>1,
       );
       $redeemResult=$this->db->insert('redeem_logs',$redeemLogs);
    }
    if($this->input->post('redeem_option')=='Renew My Account For Next Year')
    {

     $redeemResult=$this->db->set('total_amount',499)->where('student_username',$username)->update('redeem_logs');
      $this->session->set_flashdata("renew-success","congrats");
      redirect('earn-money-refer-friend');
    }

    else if($this->input->post('redeem_option')=='Registered a new Account')
    {
      $account_username=$this->generateRandomString(18);
      $manualData=array(
      'registered_account_username'=>$account_username,
      'registered_account_name'=>$this->input->post('fullname'),
      'registered_account_mobile'=>$this->input->post('mobile_number'),
      'registered_account_email'=>$this->input->post('registered_email'),

      );
       $manualResult=$this->db->set($manualData)->where('student_username',$username)->where('redeem_option',"Registered a new Account")->update('redeem_request');
       $redeemResult=$this->db->set('total_amount',499)->where('student_username',$username)->update('redeem_logs');
      // print_r($manualData);exit();
     
      $this->session->set_flashdata("registered-success","congrats");
      redirect('earn-money-refer-friend');
    }
    else
    {
       $amount=500;
       $redeemResult=$this->db->set('total_amount',$amount)->where('student_username',$username)->update('redeem_logs');
      $this->session->set_flashdata("bank-success","congrats");
      redirect('earn-money-refer-friend');
    }
  }
}
}
public function getRedeemRequests()
  {
     $username=$this->session->userdata('student_username');
    return $this->db->where('student_username',$username)->order_by('request_date','desc')->get('redeem_request');
  }
  public function getStateIdByStateName($state)
{
  $this->db->where('name',$state);
  $result=$this->db->get('states')->row();
  return $result;
}
}?>