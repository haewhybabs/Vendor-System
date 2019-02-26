<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends MY_Controller {
         public $login;
         public $company_id;
	
	   function __construct() {
            parent::__construct();
            $this->load->library(['form_validation', 'upload']);
            $this->load->model(['Director_model', 'Contact_model', 'Documents_model', 'Supplier_document_model', 'Equipment_model']);
            $this->login = $this->session->userdata('vendor_logged_in'); 
            $this->company_id=$this->login['company_id'];
        }
    
    #########################################################################################
    #########################################################################################
    #############################DIRECTOR START HERE ###################################
     public function director()
        {
        $director_list = $this->Director_model->get_by_supplier($this->company_id);   
        $data = array(
            'title' => 'Update Director',
            'director_list' => $director_list,
            
        );
           $this->template->load('template', 'update/director', $data);
        }
   
    //Updating and adding Directors
    public function director_action(){
           //Insert Vendor Director Details into database
        $this->director_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->director();
            } else {
        $director_name=$this->input->post('director_name',TRUE);
            $director_phone=$this->input->post('director_phone',TRUE);
            $director_email=$this->input->post('director_email',TRUE);
            $new_birth=$this->input->post('new_birth',TRUE);
            $join_ministry=$this->input->post('join_date',TRUE);
            $group=$this->input->post('group',TRUE);
            $bvn=$this->input->post('bvn',TRUE);
            $array_wofbi = $this->input->post('wofbi');
            $array_wofbi = implode(",", $array_wofbi);
         
               $data_director = array(
                'supplier_id'=>$this->company_id,
                'name' =>  strtoupper($director_name),
                'phone' => $director_phone,
                'email' => $director_email,
                'new_birth' => $new_birth,
                'join_ministry' => $join_ministry,
                'group' => $group,
                'wofbi' => $array_wofbi,
                'bvn' => $bvn,
                );
                $this->Director_model->insert($data_director);   
                $this->session->set_flashdata('message', 'Director record updated successfully.'); 
                redirect(site_url('update/director'));
          }
    }
    
     public function director_edit($id)
        {
        $director_list = $this->Director_model->get_by_id($id);   
        $data = array(
            'title' => 'Edit Director',
            'director' => $director_list,
            
        );
           $this->template->load('template', 'update/edit_director', $data);
        }
    
    public function director_edit_action(){
           //Insert Vendor Director Details into database
        
        $director_name=$this->input->post('director_name',TRUE);
            $director_phone=$this->input->post('director_phone',TRUE);
            $director_email=$this->input->post('director_email',TRUE);
            $new_birth=$this->input->post('new_birth',TRUE);
            $join_ministry=$this->input->post('join_date',TRUE);
            $group=$this->input->post('group',TRUE);
            $bvn=$this->input->post('bvn',TRUE);
            $array_wofbi = $this->input->post('wofbi');
            $array_wofbi = implode(",", $array_wofbi);
         
               $data_director = array(
                'supplier_id'=>$this->company_id,
                'name' =>  strtoupper($director_name),
                'phone' => $director_phone,
                'email' => $director_email,
                'new_birth' => $new_birth,
                'join_ministry' => $join_ministry,
                'group' => $group,
                'wofbi' => $array_wofbi,
                'bvn' => $bvn,
                );
                $this->Director_model->update($this->input->post('director_id'),$data_director);   
                $this->session->set_flashdata('message', 'Director record updated successfully.'); 
                redirect(site_url('update/director'));

    }
    
    
     public function director_delete($id)
        {
        if($this->Director_model->delete($id)){
             $this->session->set_flashdata('message', 'Director record deleted successfully.');
             redirect(site_url('update/director'));
        }else{
            $this->session->set_flashdata('error', 'Record not found.');
             redirect(site_url('update/director'));
        }  
        }
    
    public function director_rules(){
        $this->form_validation->set_rules('director_name', 'Director name', 'trim|required');
        $this->form_validation->set_rules('director_email', 'Director email', 'trim|required|valid_email|is_unique[supplier_directors.email]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));
        $this->form_validation->set_rules('director_phone', 'Director phone', 'trim|required');
        $this->form_validation->set_rules('bvn', 'Director BVN number', 'trim|required');
        $this->form_validation->set_rules('new_birth', 'New birth date', 'trim|required');
        ///$this->form_validation->set_rules('group', 'Church group', 'trim|required');
       // $this->form_validation->set_rules('join_date', 'Date joined ministry', 'trim|required');
        //$this->form_validation->set_rules('wofbi[]', 'WOFBI Status', 'trim|required');
    }
    
    #############################DIRECTOR ENDS HERE ###################################
    #########################################################################################
    #############################CONTACT START HERE ###################################
    
      public function contact()
        {
        $contact_list = $this->Contact_model->get_by_supplier($this->company_id);   
        $data = array(
            'title' => 'Update Contact',
            'contact_list' => $contact_list,
            
        );
           $this->template->load('template', 'update/contact', $data);
        }
   
    //Updating and adding Contacts
    public function contact_action(){
        $this->contact_rules();
         if ($this->form_validation->run() == FALSE) {
               $this->contact();
            }else {
             $data= array(
                'supplier_id'=>$this->company_id,
                'first_name' => strtoupper($this->input->post('first_name',TRUE)),
                'last_name' =>  strtoupper($this->input->post('last_name',TRUE)),
                'phone' => $this->input->post('contact_phone',TRUE),
                'email' => $this->input->post('contact_email',TRUE),
                );
                $this->Contact_model->insert($data);   
                $this->session->set_flashdata('message', 'Contact record updated successfully.'); 
                redirect(site_url('update/contact'));
          }
    }
    
     public function contact_edit($id)
        {
        $contact = $this->Contact_model->get_by_id($id);   
        if($contact){
             $data = array(
            'title' => 'Edit Contact',
            'contact' => $contact,   
        );
           $this->template->load('template', 'update/edit_contact', $data);
        }else{
           $this->session->set_flashdata('error', 'Record not found.');
             redirect(site_url('update/contact')); 
        }
        }
    
    public function contact_edit_action(){
           //Edit Vendor Contact Details into database
        
               $data = array(
                'first_name' =>  strtoupper($this->input->post('first_name',TRUE)),
                'last_name' =>  strtoupper($this->input->post('last_name',TRUE)),
                'phone' =>  $this->input->post('contact_phone',TRUE),
                'email' => $this->input->post('contact_email',TRUE),
                );
                $this->Contact_model->update($this->input->post('contact_id'),$data);   
                $this->session->set_flashdata('message', 'Contact record updated successfully.'); 
                redirect(site_url('update/contact'));

    }
    
    
     public function contact_delete($id)
        {
        if($this->Contact_model->delete($id)){
             $this->session->set_flashdata('message', 'Contact record deleted successfully.');
             redirect(site_url('update/contact'));
        }else{
            $this->session->set_flashdata('error', 'Record not found.');
             redirect(site_url('update/contact'));
        }  
        }
    
    public function contact_rules(){
        $this->form_validation->set_rules('first_name', 'Contact first name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Contact last name', 'trim|required');
        $this->form_validation->set_rules('contact_email', 'Contact email', 'trim|required|valid_email|is_unique[supplier_contact.email]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        ));
        $this->form_validation->set_rules('contact_phone', 'Contact phone', 'trim|required');
       
    }
    
    ###############################CONTACT ENDS HERE########################################
    #########################################################################################
    #############################EQUIPMENT START HERE ###################################
    
    
      public function equipment()
       {
        $equipment = $this->Equipment_model->get_all($this->company_id);
        $data = array(
            'title' => 'Upload Documents',
            'equipment' => $equipment,
        );
           $this->template->load('template', 'update/equipment', $data);
        }
    
    public function equipment_action(){
         $this->equipment_rules();
     
                if ($this->form_validation->run() == FALSE)
                {
                     $this->equipment();
                }
                else
                {
            $uploadPath = './uploads/equipments/';
            $ext = substr( strrchr($_FILES['equipment']['name'], '.'), 1);
            $new_name = date('Ymd').time().".".$ext;
                $config['file_name'] = $new_name;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
            
            if ( ! $this->upload->do_upload('equipment'))
                {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                     $this->equipment(); 
                }
                else
                {
                     $data = array(
                                'supplier_id' => $this->company_id,
                                'image'=>$new_name,
                                'name' => $this->input->post('equip_name'), 
                                'quantity'=>$this->input->post('equip_number'),
                                );
                    $this->Equipment_model->insert($data);
                    
                    $this->session->set_flashdata('message', 'Equipment image uploaded successfully');
                    redirect(site_url('update/equipment'));  
            }
                
        }
    
}
    
       public function equipment_delete($id){
            if($this->Equipment_model->get_by_id($id)){
                
                   $this->Equipment_model->delete($id);
            
                  $this->session->set_flashdata('message', 'Equipment successfully deleted');
                    redirect(site_url('update/equipment')); 
                        
              }else{
                  $this->session->set_flashdata('error', 'This Equipment does not exist');
                   redirect(site_url('update/equipment'));
              }   
          }
    
     public function equipment_rules(){
        $this->form_validation->set_rules('equip_name', 'Equipment name', 'trim|required');
          $this->form_validation->set_rules('equip_number', 'Equipment number', 'trim|required');
        }
    
    
     #########################################################################################
    #########################################################################################
    #############################DOCUMENTS START HERE ###################################
    
     public function document()
       {
        $document = $this->Documents_model->get_all();
        $support_doc= $this->Supplier_document_model->get_all($this->company_id);
        $data = array(
            'title' => 'Upload Documents',
            'document' => $document,
            'support_doc'=>$support_doc,
        );
           $this->template->load('template', 'update/documents', $data);
        }
    
    public function document_action(){
         $this->document_rules();
     
                if ($this->form_validation->run() == FALSE)
                {
                     $this->document();
                }
                else
                {
            $uploadPath = './uploads/documents/';
            $ext = substr( strrchr($_FILES['document_file']['name'], '.'), 1);
            $new_name = date('Ymd').time().".".$ext;
                $config['file_name']            = $new_name;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|doc|docx|ppt|pptx|pdf';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
            
            if (!$this->upload->do_upload('document_file'))
                {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                     $this->document(); 
                }
                else
                {
                     $data = array(
                                'supplier_id' => $this->company_id,
                                'document'=>$new_name,
                                'document_name' => $this->input->post('document'), 
                                );
                    $this->Supplier_document_model->insert($data);
                    
                    $this->session->set_flashdata('message', 'Document uploaded successfully');
                    redirect(site_url('update/document'));  
            }
                
        }
    
}
    
       public function document_delete($id){
            if($this->Supplier_document_model->get_by_id($id)){
                   $this->Supplier_document_model->delete($id);
            
                  $this->session->set_flashdata('message', 'Document successfully deleted');
                    redirect(site_url('update/document')); 
                        
              }else{
                  $this->session->set_flashdata('error', 'This Document does not exist');
                   redirect(site_url('update/document'));
              }   
          }
    
     public function document_rules(){
        $this->form_validation->set_rules('document', 'Document name', 'trim|required');
        }

}