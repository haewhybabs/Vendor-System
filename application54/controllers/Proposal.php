<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends MY_Controller {

      public $login;
    public $company_id;
    
    function __construct() {
            parent::__construct();
             $this->load->library(['form_validation', 'upload']);
           $this->load->library('template');
            $this->load->model(['Supplier_model', 'Requisition_details_model', 'Vendor_rfq_model', 'Settings_model', 'Department_requisition_model']);
            $this->login = $this->session->userdata('vendor_logged_in'); 
            $this->company_id=$this->login['company_id'];
        }
    
     public function index()
        {
        $supplier= $this->Supplier_model->get_by_id($this->company_id);
        $list = $this->Requisition_details_model->get_by_company_id2($this->company_id);
        $data = array(
             'list' => $list,
            'supplier' => $supplier,
            'title' => 'Requested Proposal',
        );
           $this->template->load('template', 'proposal/list', $data);
        }
    
    public function emails(){
         $list = $this->Requisition_details_model->get_by_company_id($this->company_id);
        print_r($list);
    }
    
    
     public function download($id)
        {
        $supplier= $this->Supplier_model->get_by_id($this->company_id);
        $list = $this->Requisition_details_model->get_by_id2($id);
        $material_list = $this->Vendor_rfq_model->get_by_req_id($id);
        $message= $this->Vendor_rfq_model->get_by_com_id($id, $this->company_id);
        $data = array(
             'list' => $list,
            'material_list' => $material_list,
            'supplier' => $supplier,
            'message'=>$message,
            'title' => 'Requested Proposal',
        );
            
         $html = $this->load->view('templates/proposal_download',$data,TRUE);
        $pdfFilePath = "Request For Quotation.pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
}
    
     public function upload($id)
        {
        $supplier= $this->Supplier_model->get_by_id($this->company_id);
        $message= $this->Vendor_rfq_model->get_by_com_id($id, $this->company_id);
        if($message){
            $data = array(
            'supplier' => $supplier,
            'message'=>$message,
            'title' => 'Upload Proposal',
        );
          $this->template->load('template', 'proposal/form', $data);   
        }else{
          $this->session->set_flashdata('error', 'This detail does not exist');
             redirect(site_url('proposal'));    
        } 
}
    
     public function upload_action(){
        // $this->document_rules();
         $message= $this->Vendor_rfq_model->get_by_com_id($this->input->post('quote_id'), $this->company_id);
         if($message->upload == ''){
             $uploadPath = './uploads/proposal/';
            $ext = substr( strrchr($_FILES['document_file']['name'], '.'), 1);
            $new_name = date('Ymd').time().".".$ext;
                $config['file_name']            = $new_name;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'doc|docx|pdf';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
            
            if (!$this->upload->do_upload('document_file'))
                {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                     $this->document(); 
                }
                else
                {
                    $date=date('Y-m-d');
                     $data = array(
                        'upload'=>$new_name,
                        'sent_quotation' => 1, 
                         'submission_date'=>$date,
                    );
                    $this->Vendor_rfq_model->update_quote($this->input->post('quote_id'), $this->company_id, $data);
                    
                    $this->session->set_flashdata('message', 'Document uploaded successfully');
                    redirect(site_url('proposal'));  
            }
         }
         else{
             $this->session->set_flashdata('error', 'Quotation already uploaded and submitted');
             redirect(site_url('proposal/upload/'.$this->input->post('quote_id')));   
         }
                
        }
    
        public function submit()
        {
        $supplier= $this->Supplier_model->get_by_id($this->company_id);
        $list = $this->Requisition_details_model->get_by_company_id2($this->company_id);
        $data = array(
             'list' => $list,
            'supplier' => $supplier,
            'title' => 'Submitted Proposal',
        );
           $this->template->load('template', 'proposal/submitted', $data);
        }
    
        public function status()
        {
        $supplier= $this->Supplier_model->get_by_id($this->company_id);
        $list = $this->Requisition_details_model->get_by_company_id2($this->company_id);
        $data = array(
             'list' => $list,
            'supplier' => $supplier,
            'title' => 'Proposal Status',
        );
           $this->template->load('template', 'proposal/status', $data);
        }
 
     public function document_rules(){
        $this->form_validation->set_rules('document', 'Document name', 'trim|required');
        }
       
}
           