<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends BaseController
{
    public $title = 'First to CodeIgniter';

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *     - or -
     *         http://example.com/index.php/welcome/index
     *     - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('home');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->view('crud/create');
    }

    public function store()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if (!$this->form_validation->run()) {
            $this->load->view('crud/create');
        }

        $this->users_model->insert();
        redirect('/crud/show');
    }

    public function show()
    {
        $data['users'] = $this->users_model->retrieve();
        $this->load->view('crud/show', $data);
    }

    public function edit()
    {
        $this->load->view('crud/edit');
    }

    public function destroy()
    {
        $this->load->view('crud/destroy');
    }
}
