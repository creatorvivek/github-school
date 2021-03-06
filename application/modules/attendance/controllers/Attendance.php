  <?php


class Attendance extends MY_Controller{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Attendance_model');
    $this->load->model('classes/Classes_model');
    $this->load->model('student/Student_model');
  } 

/*
* Listing of attendance
*/


/*
* Adding a new attendance
*/
function take_attendance()
{ 
  $data['title']="Take Attendance";
  $school_id=$this->session->SchoolId;
  $condition=array('school_id'=>$school_id);
  $data['cources'] = $this->Attendance_model->select('table_courses',$condition,array('*'));
  $data['_view'] = 'take_attendence';
  $this->load->view('index',$data);
}



function fetchStudent() 
{   


  $course_id=$this->input->post('course_id',1);
  $batch_id=$this->input->post('batch_id',1);
  $data['date_select']=$this->input->post('date_select',1);
  $condition=array('batch_id'=>$batch_id,'school_id'=>$this->session->SchoolId);
  // $data['students'] = $this->Student_model->fetch_students($data['classID']);
  $data['students'] = $this->Attendance_model->fetch_students_by_batch('table_assign_student',$condition,array('student.id','student.name'));
  $data['batch_id']=$batch_id;

  ##fetch batch name and course name by id
  $data['fetch_name']=$this->Attendance_model->fetch_name_batch('table_batch',array('course_id'=>$course_id,'batch.id'=>$batch_id,'batch.school_id'=>$this->session->SchoolId),array('course_name','batch_name'));
// print_r($data['fetch_name']);
// $this->output->enable_profiler(TRUE);
// die;
// var_dump( $data['students'] );die;
  $data['_view'] = 'add';
  $this->load->view('index',$data);
}
function insertAttendance()
{   
  $batch_id=$this->session->batchID;
  $attendanceDate=$this->session->attendance_date;
  // $batch_id= $this->input->post('batch_id');
  $attendenceData = $this->input->post();
  // echo '<pre>';
// print_r($attendanceDate);
// print_r($batch_id);
// die;

#collect data for insertion into insertionData
  $insertionData = array();

  foreach ($attendenceData as $studentName => $status) {

##change in future, (temporary code)
    $data=array(
      'student_id'=>$studentName,
      'attendance_status'=>$status,
      'batch_id'=>$batch_id,
      'school_id'=>$this->session->SchoolId,
      'date'=>$attendanceDate,
      'staff_id'=> $this->session->StaffId


    );

    array_push($insertionData,$data);
    // print_r($data);
  }
// print_r($insertionData);die;
// $this->Attendance_model->insert_attendance($insertionData);
  $this->db->insert_batch('attendance_record',$insertionData);
   // $this->session->unset_userdata('batchID');
   // echo $batch_id;
  redirect("attendance/attendance_list");

}
function attendance_list()
{
  $data['title']="Attendance list";
  $school_id=$this->session->SchoolId;
  $school_id=$this->session->SchoolId;
  $condition=array('school_id'=>$school_id);
  $data['classes'] = $this->Attendance_model->select('table_courses',$condition,array('*'));
  // $data['classes'] = $this->Classes_model->fetch_classes($school_id);
// var_dump($data['classes'] );die;
  $data['_view'] = 'selectList';
  $this->load->view('index',$data);

}

function show_report()
{
  $data['title']="Show Report";
  $school_id=$this->session->SchoolId;
  $classId= $this->input->post('id');
  $date= $this->input->post('date');
  $this->load->helper('user_helper');
   // $date_range = explode(' - ',$date);
  $start_date = date_change_db($date);
    // echo json_encode($start_date);

  $data['report'] = $this->Attendance_model->fetch_report($school_id,$classId,$start_date);

  $this->load->model('student/Student_model');
  $data['student']=$this->Student_model->fetch_student_name($school_id);
  echo json_encode($data);

}


/*
* Deleting attendance
*/
function remove($id)
{
  $attendance = $this->attendance_model->get_attendance($id);

// check if the attendance exists before trying to delete it
  if(isset($attendance['id']))
  {
    $this->attendance_model->delete_attendance($id);
    redirect('attendance/attendance_list');
  }
  else
    show_error('The attendance you are trying to delete does not exist.');
}
function fetch_student()
{
  $classes_id=$this->input->post('classes_id');
  echo json_encode($this->Attendance_model->fetch_students($classes_id));
}


function test()
{
  $this->load->helper('user_helper');
  $date='09-04-2019';
  $start_date = date_change_db($date);
  echo ($start_date);
}

 // array('student_id','student.name','attendance_status','attendance_record.date'));
function attendance_report()
{
  $data['title']="Attendance Report";
  $school_id=$this->session->SchoolId;

  if($this->input->post())
  {
    $month=$this->input->post('month',1);
    $year=$this->input->post('year',1);
    $batch_id=$this->input->post('batch_id',1);
    $data['no_of_days']=cal_days_in_month(CAL_GREGORIAN,$month,$year);
    $data['attendance_report']=$this->Attendance_model->fetch_students_by_batchs('table_attendance',array('school_id'=>$school_id,'month(date)'=>$month,'year(date)'=>$year,'batch_id'=>$batch_id),       array('*'));
    echo '<pre>';
    print_r( $data['attendance_report']);
    die;
    $s=[];
    for($i=0;$i<count($data['attendance_report']);$i++)
    {
          if($data['attendance_report'][$i]['student_id']==2)
          {
            array_merge($s,$data['attendance_report']);
          }
    }
    print_r($s);
    die;
  }
  else
  {
    $data['attendance_report']=[];
   // $data['no_of_days']=[];
  }
  $condition=array('school_id'=>$school_id);
  $data['course'] = $this->Attendance_model->select('table_courses',$condition,array('*'));
  $data['_view'] = 'attendance_report';
  $this->load->view('index',$data);

}
















}
