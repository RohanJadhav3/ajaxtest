<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		$this->load->view('homepage');
	}

	public function showregs()
	{
		$html = $this->load->view('register', "", true);
		$response['html'] = $html;
		echo json_encode($response);
	}

	public function savedata()
	{


		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		// $config = array(
		// 'upload_path' => './uploads/',
		// 'allowed_types' => 'jpg|png|jpeg'
		// );

		// $this->load->library('upload', $config);

		if ($this->form_validation->run() == true) {

			$filename = '';
			// if (!$_FILES == ''){

			// 	$this->upload->do_upload('image');
			// 	$file = $this->upload->data();
			// 	$filename = $file['file_name'];
			// } else {
			// 	echo $this->upload->display_errors();
			// }


			// save to db
			$formArray = array();
			$formArray['name'] = $this->input->post('name');
			$formArray['email'] = $this->input->post('email');
			$formArray['password'] = $this->input->post('password');
			$formArray['image'] = $filename;

			$this->db_qry->insert($formArray);

			// $row = $this->db_qry->getrow($id);
			// $vdata['row'] = $row;
			// $rowhtml = $this->load->view('list', $vdata, true);

			// $response['row'] = $rowhtml;
			// $response['status'] = 1;

			// Load PHPMailer library
			$this->load->library('phpmailer_lib');

			// PHPMailer object
			$mail = $this->phpmailer_lib->load();

			// SMTP configuration
			$mail->isSMTP();
			$mail->Host     = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'rohan.it@selloship.com';
			$mail->Password = 'yyfsruvrtzxpuryx';
			$mail->SMTPSecure = 'ssl';
			$mail->Port     = 465;
			$mail->isSMTP();

			$mail->setFrom('rohan.it@selloship.com', 'Rohan Jadhav');
			// Add a recipient
			$mail->addAddress($this->input->post('email'));
			// Email subject
			$mail->Subject = 'successfully registered';
			// Set email format to HTML
			$mail->isHTML(true);
			// Email body content
			$mailContent = "<h1>Registered Successfully</h1>
	 
				 <p> Thank You for register on our Website  </p>";
			$mail->Body = $mailContent;
			// Send email
			if (!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			}
			$response['message'] = "<div class=\"alert alert-success\"> Record has been added successfully.</div>";

			echo json_encode($response);
		} else {
			$response['status'] = 0;
			$response['name'] = strip_tags(form_error('name'));
			$response['email'] = strip_tags(form_error('email'));
			$response['password'] = strip_tags(form_error('password'));
		}
	}

	public function showlist($offset = null)
	{
		$search = array(
			'keyword' => trim($this->input->post('search_key')),
		);

		$this->load->library('pagination');

		$limit = 3;
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$config['base_url'] = base_url('home/showlist/');
		$config['total_rows'] = $this->db_qry->getdata($limit, $offset, $search, $count = true);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="" class="current_page">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$data['rows'] = $this->db_qry->getdata($limit, $offset, $search, $count = false);

		$data['pagelinks'] = $this->pagination->create_links();

		$this->load->view('list', $data);
	}





	public function getuserdata($id)
	{
		$row = $this->db_qry->getrow($id);
		$data['row'] = $row;
		$html = $this->load->view('edit', $data, true);
		$response['html'] = $html;
		echo json_encode($response);
	}

	// THIS FUNCTION IS FOR UPDATE THE DATA WITH EDIT FORM 
	public function updatedata()
	{
		$id = $this->input->post('id');
		$row = $this->db_qry->getrow($id);
		if (empty($row)) {
			$response['msg'] = "Record Deleted Or Not Found in database ";
			$response['status'] = 100;
			json_encode($response);
			exit;
		}


		// this is for form validation 

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() == true) {
			// updated  to db
			$formArray = array();
			$formArray['name'] = $this->input->post('name');
			$formArray['email'] = $this->input->post('email');
			$formArray['password'] = $this->input->post('password');

			$id = $this->db_qry->update($id, $formArray);

			$row = $this->db_qry->getrow($id);

			$response['row'] = $row;
			$response['status'] = 1;
			$response['message'] = "<div class=\"alert alert-success\"> Record has been Updated successfully.</div>";
			echo json_encode($response);
		} else {
			$response['status'] = 0;
			$response['name'] = strip_tags(form_error('name'));
			$response['email'] = strip_tags(form_error('email'));
			$response['password'] = strip_tags(form_error('password'));
			echo json_encode($response);
		}
	}

	// THIS IS FUNCTION IS USED TO DELETE THE DATA FROM DATABSE 
	public function deletedata($id)
	{

		if (empty($row)) {
			$row = $this->db_qry->getrow($id);

			// HERE WE HAVE GIVEN A CONDITION FOR IF THE ROW IS EMPTY OR NO DATA IS AVAILIABLE IN IT THEN IT WILL SHOW A MASSAGE CONTAINS THAT RECORD IS ALREADY DELETED
			if (empty($row)) {
				$response['message'] = "<div class=\"alert alert-warning\"> Record Already Deleted Or Not Found in database  </div>";
				$response['status'] = 0;
				echo json_encode($response);
				exit;
			} else {
				$this->db_qry->delete($id);
				$response['msg'] = "<div class=\"alert alert-success\"> Record Has Been Deleted Successfully </div> ";
				$response['status'] = 1;
				echo json_encode($response);
			}
		}
	}

	public function showlogin()
	{
		$html = $this->load->view('login', "", true);
		$response['html'] = $html;
		echo json_encode($response);
	}

	public function check_login()
	{
		$this->load->library('session');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() !== false) {

			$result = $this->db_qry->checkLogin();
			if ($result) {
				$response['status'] = 1;
				$response['message'] = "<div class=\"alert alert-success\"> Log in success </div>";
				echo json_encode($response);

				$sdata['email'] = $result->email;
				$this->session->set_userdata($sdata);
			} else {
				$response['status'] = 0;
				$response['email'] = strip_tags(form_error('email'));
				$response['password'] = strip_tags(form_error('password'));
				$response['message'] = "<div class=\"alert alert-danger\"> invalid email or password </div>";
				echo json_encode($response);
			}
		} else {


			$response['status'] = 0;
			$response['email'] = strip_tags(form_error('email'));
			$response['password'] = strip_tags(form_error('password'));


			echo json_encode($response);
		}
	}


	public function logout()
	{
		print_r($this->session->userdata());

		$this->session->unset_userdata('email');

		return redirect(base_url());
	}


	public function welcome()
	{
		if ($this->session->has_userdata('email')) {
			$this->load->view('welcome');
		} else {
			return redirect('home/logout');
		}
	}

	 function upload_file() {

		$filename = '';
		$formArray['image'] = $filename;

        //upload file
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;
       

        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : uploads/' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {
                        echo 'File successfully uploaded : uploads/' . $_FILES['file']['name'];
                    }
                }
            }
        } else {
            echo 'Please choose a file';
        }
    }

	// public function uploadfile()
	// {

	// 	$config = array(
	// 		'upload_path' => './uploads/',
	// 		'allowed_types' => 'jpg|png|jpeg'
	// 	);

	// 	$this->load->library('upload', $config);


	// 	if ($this->form_validation->run() == true) {

	// 		$filename = '';
	// 		if (!$this->upload->do_upload('image')) {
	// 			echo $this->upload->display_errors();
	// 		} else {
	// 			$file = $this->upload->data();
	// 			$filename = $file['file_name'];
	// 		}
	// 	}
	// }
}
?>
	




<?php
// public function showlist()
// {

// $row = $this->db_qry->listdata();
// $data['rows'] = $row;

// $html = $this->load->view('list', $data, true);
// $response['html'] = $html;
// echo json_encode($response);
// }
?>