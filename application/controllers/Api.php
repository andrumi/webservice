<?php


class Api extends CI_Controller {
	
	public function __construct()
        {
                parent::__construct();
                $this->load->model('api_model');
                $this->load->helper('url_helper');
        }

/* 	public function view($page = 'index')
	{
		if ( ! file_exists(APPPATH.'views/api/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('api/'.$page, $data);

	} */
	public function index($id = NULL){
			$data['heroes'] = $this->api_model->get_heroes();

			header('Content-Type: application/json');
			echo json_encode($data['heroes']);
	}

	public function detail($id = NULL){
			$data['hero_item'] = $this->api_model->get_hero($id);
			header('Content-Type: application/json');
			echo json_encode($data['hero_item']);
	}
	public function insert (){
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
        $name = $request->name;
		$newid = $this->api_model->insert_hero($name);
		$data['hero_item'] = $this->api_model->get_hero($newid);
		header('Content-Type: application/json');
		echo json_encode($data['hero_item']);
	}
	public function delete (){
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

        $id = $request->id;

		$success = $this->api_model->delete_hero($id);
		
		header('Content-Type: application/json');
		echo json_encode($success);	
	}
	public function update (){
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		
		log_message('debug','postdata = '.$postdata);
		$request = json_decode($postdata);
		$hero2= $request->hero2;
		log_message('debug','the request id = '.$hero2);
		$object= json_decode($hero2);
		$data['id'] = $object->id;
		log_message('debug','id = '.$data['id']);
		$data['name'] = $object->name;
		$success = $this->api_model->update_hero($data);
		log_message('debug','sucess = '.$success);
		$return = '{"TRUE":TRUE}';
		header('Content-Type: application/json');
		echo json_encode($return);	
	}
}
