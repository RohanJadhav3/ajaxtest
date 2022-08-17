public function showlist($offset=null)
	{
		$search = array(
			'keyword' => trim($this->input->post('search_key')),
		);
		
		$this->load->library('pagination');
		
		$limit = 3;
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$config['base_url'] = base_url('home/showlist/');
		$config['total_rows'] = $this->db_qry->getdata($limit, $offset, $search, $count=true);
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

		$data['rows'] = $this->db_qry->getdata($limit, $offset, $search, $count=false);
	
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

	// public function showlogin()
	// {
	// 	$html = $this->load->view('login', "", true);
	// 	$response['html'] = $html;
	// 	echo json_encode($response);
	// }

	public function cmflogin()
    {
        /*Load the login screen, if the user is not log in*/
        if (isset($_SESSION['login']['idUser'])) {
            /*check the session of user, if it is available, it means the user is already log in*/
            $this->load->view('dashboard');
        } else {
            /*if not, display the login window*/
            $this->load->view('login');
        }
    }

    public function dashboard()
    {
        /*Load the dashboard screen, if the user is already log in*/
        if (isset($_SESSION['login']['idUser'])) {
            $this->load->view('welcome');
        } else {
            $this->load->view('login');
        }
    }

    function getLogin()
    {
        /*Data that we receive from ajax*/
        $email = $this->input->post('email');
        $Password = $this->input->post('Password');
        if (!isset($email) || $email == '' || $email == 'undefined') {
            /*If Username that we recieved is invalid, go here, and return 2 as output*/
            echo 2;
            exit();
        }
        if (!isset($Password) || $Password == '' || $Password == 'undefined') {
            /*If Password that we recieved is invalid, go here, and return 3 as output*/
            echo 3;
            exit();
        }
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('Password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            /*If Both Username &  Password that we recieved is invalid, go here, and return 4 as output*/
            echo 4;
            exit();
        } else {
            /*Create object of model MLogin.php file under models folder*/
            $Login = new db_qry();
            /*validate($username, $Password) is the function in Mlogin.php*/
            $result = $Login->validate($email, $Password);
            if (count($result) == 1) {
                /*If everything is fine, then go here, and return 1 as output and set session*/
                $data = array(
                    'idUser' => $result[0]->idUser,
                    'email' => $result[0]->email
                );
                $this->session->set_userdata('login', $data);
                echo 1;
            } else {
                /*If Both Username &  Password that we recieved is invalid, go here, and return 5 as output*/
                echo 5;
            }
        }
    }
}

	

?>
