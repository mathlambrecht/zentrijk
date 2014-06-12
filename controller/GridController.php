<?php

require_once WWW_ROOT.'controller'.DS.'AppController.php';
require_once WWW_ROOT.'dao'.DS.'SpotsDAO.php';

class GridController extends AppController 
{
	public $PhotosDAO;

	public function __construct() 
    {
        parent::__construct();
        require_once WWW_ROOT.'dao'.DS.'PhotosDAO.php';
        $this->photosDAO = new PhotosDAO();
    }

    public function grid()
    {
        if(!empty($_GET['action']) && $_GET['action'] == 'view')
        {
            $this->view();
            exit();
        }

        if(!empty($_GET['action']) && $_GET['action'] == 'login')
        {
            $this->login();
            exit();
        }

        if(!empty($_GET['action']) && $_GET['action'] == 'create')
        {
            $this->login();
            exit();
        }
    }

    public function view()
    {
        require_once WWW_ROOT.'pages'.DS.'parts'.DS.'view.php';
    }

    public function login()
    {
        require_once WWW_ROOT.'pages'.DS.'parts'.DS.'login.php';
    }

    public function create()
    {
        
    }
}
