<?php


class Api extends CI_Controller {
	
	public function __construct()
        {
			    
                parent::__construct();
                $this->load->model('api_model');
                $this->load->helper('url_helper');
				header('Access-Control-Allow-Origin:*');//this is a bit dodgy allowing access from anything
							
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
    public function getitems($id = NULL){
			$data['items'] = $this->api_model->get_items();
            
			header('Content-Type: application/json');
			echo json_encode($data['items']);
	}
	public function detail2($id = NULL){
			$data['item_item'] = $this->api_model->get_item($id);
			header('Content-Type: application/json');
			echo json_encode($data['item_item']);
	}
	public function register (){
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);

        $name = $request->name;
		$newid = $this->api_model->register($name);
		$data['user_item'] = $this->api_model->get_user($newid);
		header('Content-Type: application/json');
		echo json_encode($data['user_item']);
	}
	public function newitem (){
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
        $name = $request->name;
		log_message('debug','postdata = '.$postdata);
		log_message('debug','name = '.$name);
		$newid = $this->api_model->insert_newitem($name);
		$data['item_item'] = $this->api_model->get_item($newid);
		header('Content-Type: application/json');
		echo json_encode($data['item_item']);
	}
	public function delete_item (){
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
        $id = $request->id;
		$success = $this->api_model->delete_item($id);		
		header('Content-Type: application/json');
		echo json_encode($success);	
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
		log_message('debug','request = '.$hero2);
		$object= json_decode($hero2);
		$data['id'] = $object->id;
		log_message('debug','id = '.$data['id']);
		$data['name'] = $object->name;
		log_message('debug','name = '.$data['name']);
		$success = $this->api_model->update_hero($data);
		log_message('debug','sucess = '.$success);
		
		header('Content-Type: application/json');
		echo json_encode($success);	
	}
}
