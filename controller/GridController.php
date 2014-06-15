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

    private $isArrGridPhotos;

	public function __construct() 
    {
        parent::__construct();

        $this->userDAO = new UserDAO();
        $this->photosDAO = new PhotosDAO();
        $this->gridDAO = new gridDAO();
    }

    public function grid()
    {
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

        if(!empty($_GET['action']) && $_GET['action'] == 'logout')
        {
            unset($_SESSION['code']);
            unset($_SESSION['groupid']);

            $_SESSION['isLoggedIn'] = false;

            header('Location:index.php?page=home');
            exit();
        }
        else
        {
            header('Location:index.php?page=grid&action=login');   
            exit();
        }
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

                $isArrGridPhotos = false;

                header('Location:index.php?page=grid&action=showgrid');
                exit();
            }
        } 
        elseif(!empty($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'])
        {
            header('Location:index.php?page=grid&action=showgrid');
            exit();
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
            if(file_exists(WWW_ROOT.DS.'grids'.DS.$_SESSION['code'].$_SESSION['groupid'].'.json'))
            {
                $json = file_get_contents(WWW_ROOT.DS.'grids'.DS.$_SESSION['code'].$_SESSION['groupid'].'.json');
                $json = json_decode($json, true);

                $isArrGridPhotos = true;

                $arrGridPhotos = $json['grid']['images'];

                $this->set('isArrPhotos', true);
                $this->set('arrGridPhotos', $arrGridPhotos);
            }
            else
            {
                $isArrGridPhotos = false;
            }

            require_once WWW_ROOT.'pages'.DS.'parts'.DS.'grid.php';                                
        }
        else
        {
            header('Location:index.php?page=grid&action=login');   
            exit();
        }
    }

    public function showPhotos()
    {
        if(!empty($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'])
        {
            if(!empty($_SESSION['code']) && !empty($_SESSION['groupid']))
            {
                $arrPhotos = $this->photosDAO->getPhotosByCodeAndGroupId($_SESSION['code'], $_SESSION['groupid']);
                $this->set('arrPhotos', $arrPhotos);

                $_SESSION['gridid'] = $_POST['gridid'];

                require_once WWW_ROOT.'pages'.DS.'parts'.DS.'assign.php';
            }
        }
        else
        {
            header('Location:index.php?page=grid&action=login');   
            exit();
        }
    }

    public function assignPhoto()
    {
        if(!empty($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'])
        {
            if(file_exists(WWW_ROOT.DS.'grids'.DS.$_SESSION['code'].$_SESSION['groupid'].'.json'))
            {
                //add to json
                $json = file_get_contents(WWW_ROOT.DS.'grids'.DS.$_SESSION['code'].$_SESSION['groupid'].'.json');
                $json = json_decode($json, true);

                $newimage = array('photopath' => $_POST['photopath'], 'gridid' => (string)$_SESSION['gridid']);
                array_push($json['grid']['images'], $newimage);
                $json = json_encode($json);
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
            }

            $json = utf8_decode($json);

            $fp = fopen(WWW_ROOT.DS.'grids'.DS.$_SESSION['code'].$_SESSION['groupid'].'.json', 'w');
            fwrite($fp, $json);
            fclose($fp);
        }

        header('Location:index.php?page=grid&action=showgrid');
        exit();
    }
}