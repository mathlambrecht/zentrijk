<?php
require_once WWW_ROOT.'controller'.DS.'AppController.php';

require_once WWW_ROOT.'dao'.DS.'UserDAO.php';
require_once WWW_ROOT.'dao'.DS.'PhotosDAO.php';
require_once WWW_ROOT.'dao'.DS.'GridDAO.php';

class GridController extends AppController 
{
    public $UserDAO;
    public $PhotosDAO;
    public $GridDAO;

	public function __construct() 
    {
        parent::__construct();

        $this->userDAO = new UserDAO();
        $this->photosDAO = new PhotosDAO();
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

        if(!empty($_GET['action']) && $_GET['action'] == 'showgrid')
        {
            $this->showGrid();
            exit();
        }

        if(!empty($_GET['action']) && $_GET['action'] == 'showphotos')
        {
            $this->showPhotos();
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
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['code'] = $result['code'];
                $_SESSION['groupid'] = $_POST['selectgroup'];

                header('Location:index.php?page=index&action=showgrid');
            }
        } 
        elseif(!empty($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'])
        {
            header('Location:index.php?page=grid&action=showgrid');
        }
        else
        {
            //feedback wrong form
            require_once WWW_ROOT.'pages'.DS.'parts'.DS.'login.php';
        }
    }

    public function showGrid()
    {
        if(!empty($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'])
        {
            if(file_exists(WWW_ROOT.$_SESSION['code'].$_SESSION['groupid'].'.json'))
            {
                $json = file_get_contents(WWW_ROOT.$_SESSION['code'].$_SESSION['groupid'].'.json');
                $json = json_decode($json, true);

                $isArrGridPhotos = true;

                $arrGridPhotos = $json['grid']['images'];

                $this->set('isArrPhotos', true);
                $this->set('arrGridPhotos', $arrGridPhotos);

                require_once WWW_ROOT.'pages'.DS.'parts'.DS.'grid.php';                                
            }
        }
        else
        {
            header('Location:index.php?page=grid&action=login');   
        }
    }

    public function showPhotos()
    {
        $arrPhotos = $this->photosDAO->getPhotosByCodeAndGroupId($_SESSION['code'], $_SESSION['groupid']);
        $this->set('arrPhotos', $arrPhotos);

        $_SESSION['gridid'] = $_POST['gridid'];

        require_once WWW_ROOT.'pages'.DS.'parts'.DS.'assign.php';
    }

    public function assignPhoto()
    {
        $result = false;

        if($result)
        {
            //add to json
        }
        else
        {
            $json = 
            '{ 
                "grid":
                    {
                        "code":"'.$_SESSION["code"].'",
                        "groupid":"'.(string)$_SESSION["groupid"].'",
                        "images":
                        {
                            "image":
                            {
                                "photopath":"'.$_POST["photopath"].'",
                                "gridid":"'.(string)($_SESSION["gridid"]).'"
                            }
                        }
                    }
                }';

            $json = utf8_decode($json);

            $fp = fopen(WWW_ROOT.$_SESSION['code'].$_SESSION['groupid'].'.json', 'w');
            fwrite($fp, $json);
            fclose($fp);

            header('Location:index.php?page=grid&action=showgrid');
        }
    }
}