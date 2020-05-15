<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class ContactController extends CI_Controller {

    

    function __construct() {

        parent::__construct();
        
        date_default_timezone_set("Asia/Calcutta");

        $this->load->model("AdminModel");
        $this->load->model("HomeModel");

    }


    function template($page_name, $pagedata, $footerdata)
    {
         
         $this->load->view('web/header');
         $pagedata['videos'] = $this->HomeModel->fetch_videos();
         $this->load->view($page_name, $pagedata);
         $this->load->view('web/footer');
    }

   
    function contact(){

        $pagedata   =   Array();  
        
        $this->template('web/contact', $pagedata, 'NULL');

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

    function submit_contact(){   

        $from = trim($_POST['email']);
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $subject = trim($_POST['subject']);
        $message = trim($_POST['message']);      

        $this->load->library('phpmailer_lib');
        $mail = $this->phpmailer_lib->load();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.hostinger.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'hamdard@p1web.site';
        $mail->Password = 'Pk*I&#K#';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;
        
        $mail->setFrom($from, $fname);
        $mail->addReplyTo($from, 'hamdard');
        
        // Add a recipient
        $mail->addAddress('pvndb2015@gmail.com');
        
        // Add cc or bcc 
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = $subject;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = $message;
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            $result['error'] = 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            $result['error'] = 'Message has been sent';
        }

        echo json_encode($result);
        
    }
   

}