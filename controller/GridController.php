<?php

require_once WWW_ROOT.'controller'.DS.'AppController.php';

require_once WWW_ROOT.'dao'.DS.'UserDAO.php';
require_once WWW_ROOT.'dao'.DS.'GridDAO.php';

class GridController extends AppController 
{
    public $UserDAO;
    public $GridDAO;

	public function __construct() 
    {
        parent::__construct();

        $this->userDAO = new UserDAO();
        $this->gridDAO = new gridDAO();
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

        if(!empty($_GET['action']) && $_GET['action'] == 'assignphoto')
        {
            $this->assignPhoto();
            exit();
        }
    }

    public function view()
    {
        require_once WWW_ROOT.'pages'.DS.'parts'.DS.'view.php';
    }

    public function login()
    {
        if(!empty($_POST['txtcode']) && !empty($_POST['selectgroup']))
        {
            $result = $this->userDAO->validateCode($_POST['txtcode']);

            if(!$result)
            {
                //wrong
                require_once WWW_ROOT.'pages'.DS.'parts'.DS.'login.php';
            }
            else
            {
                $_SESSION['code'] = $result['code'];
                $_SESSION['groupid'] = $_POST['selectgroup'];

                require_once WWW_ROOT.'pages'.DS.'parts'.DS.'new.php';
            }
        } 
        else
        {
            //feedback wrong form
            require_once WWW_ROOT.'pages'.DS.'parts'.DS.'login.php';
        }
    }

    public function assignphoto()
    {
        $arrPhotos = $this->gridDAO->getPhotosByCodeAndGroupId($_SESSION['code'], $_SESSION['groupid']);
        $this->set('arrPhotos', $arrPhotos);

        require_once WWW_ROOT.'pages'.DS.'parts'.DS.'assign.php';
    }
}
