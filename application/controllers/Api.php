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
	public function index($id = NULL)
	{
			$data['heroes'] = $this->api_model->get_heroes();

			header('Content-Type: application/json');
			echo json_encode($data['heroes']);
	}

	public function detail($id = NULL)
	{
			$data['hero_item'] = $this->api_model->get_hero($id);
			header('Content-Type: application/json');
			echo json_encode($data['hero_item']);
	}

}
