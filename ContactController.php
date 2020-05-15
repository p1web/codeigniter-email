<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContactController extends CI_Controller { 
    
    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Calcutta");
    }

 
    function contact(){
        
        $this->load->view('contact');

    }
     
    public function send_mail() { 

        $from_email = $this->input->post('email');
        $to_email = "rashtraajkal@gmail.com"; 

        $fname = trim($this->input->post('fname'));
        $lname = trim($this->input->post('lname'));
        $subject = trim($this->input->post('subject'));
        $message = trim($this->input->post('message'));
   
         //Load email library 
        $this->load->library('email');

        $htmlContent = '<h3>Website Contact Query</h3>';
        $htmlContent .= '<p>Name : '.$fname.' '.$lname.'</p>';
        $htmlContent .= '<p>Subject : '.$subject.'</p>';
        $htmlContent .= '<p>Message : '.$message.'</p>';
            
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
   
        $this->email->from($from_email, $this->input->post('fname')); 
        $this->email->to($to_email);
        $this->email->subject($this->input->post('subject')); 
        $this->email->message($htmlContent); 
   
         //Send mail 
         if($this->email->send()){
            $error_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>Success!</strong> Your contact send successfully
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>';
            $result['result'] = true;
            $result['message'] = $error_msg;
         }else{
            $error_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>Fail!</strong> There is something wrong! Try later.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>';
            $result['result'] = false;
            $result['message'] = $error_msg;
         }

         echo json_encode($result);
         
    }  

}
