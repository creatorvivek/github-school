<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
         date_default_timezone_set("Asia/Kolkata");

    }

    public function index($msg = NULL)
    {
// Load our view to be displayed
         $data['title']="login";
        if (isset($this->session->school_username)) {
            redirect('admin');
        }
// to the user
        $data['msg'] = $msg;
        $this->load->view('login', $data);
    }


    public function process()
    {
//load session library

        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));


        $authenticationData = $this->Login_model->getResult($username,$password);

##function for ip address
        $ipaddress = '';

        if(isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';


##generating logs

        $logsData=array(
            'username'=>($authenticationData['username'])?$authenticationData['username']:$username,
            'ip_address'=>$ipaddress,
            'status'=>($authenticationData)?1:0
        );
        $log=$this->Login_model->insertLogs($logsData);

##--##
        if (is_null($authenticationData)) {
            $data = array(
                'error_message' => 'Invalid Username or Password'
            );
            $this->load->view('login', $data);
        }else{
            $autorizationData = $this->Login_model->getAutorization($authenticationData['autorization_id']);

#set session data
          
            $this->session->user_id = $authenticationData['auth_id'];
            $this->session->school_username = $authenticationData['username']; 
            $this->session->auto_logout = $authenticationData['auto_logout_status']; 
            $this->session->autorization_id = $autorizationData['type'];
            $this->session->log_id=$log;
$this->session->name = ''; #default value
$this->session->profileImage = ''; #default value
$userData = '';
switch ($authenticationData['autorization_id']){
    case 1:
    case 2:
#got for admin user at employ table & check for authentication ID and get school id
    $userData = $this->Login_model->getEmployDetails($authenticationData['user_id']);
    $this->session->SchoolId = $userData['school_id'];
     $this->session->StaffId = $userData['id'];
// $this->session->organizationName = $userData['organization_name'];
    $school_name= modules::run('admin/admin/getSchoolName',$this->session->SchoolId);
    $this->session->SchoolName =$school_name['organization_name'];

    $this->session->name = $userData['name'];
    $this->session->profileImage = $userData['profile_image'];
    $this->session->authenticationId=$authenticationData['autorization_id'];
    // echo "admin  ". $this->session->school_username;
    redirect ('admin');

    break;

    case 3:
#got for parent
    case 4:
#got for student
    $this->session->school_username;
// $this->session->school_username
    $this->session->authenticationId=$authenticationData['autorization_id'];
    redirect('profile');
    break;
    case 5;
    $this->session->superusername=$authenticationData['username'];
    $this->session->authenticationId=$authenticationData['autorization_id'];
    redirect('superadmin/admin_index');
    break;

}
#redirect it to $autorizationData['home']
echo 'redirect it to '. $autorizationData['home'];
// $this->output->enable_profiler(TRUE);

// echo $_SESSION['username'];


}



}

public function logout(){
    $log_id=$this->session->log_id;

    $logout_time=date("Y-m-d H:i:s");
    $this->Login_model->set_logout_time($log_id,$logout_time);
    $this->session->unset_userdata('school_username');
    $this->session->unset_userdata('profileImage');
    $this->session->unset_userdata('SchoolId');
    $this->session->unset_userdata('log_id');
    $this->session->sess_destroy();
    redirect('login');
}       






}

// }
?>