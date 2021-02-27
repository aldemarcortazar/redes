<?php

class SessionController extends Controller{
    private $user_Session;
    private $user_name;
    private $user_id;
    private $session;
    private $sites;
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->init(); 
    }

    public function get_user_Session(){        
        return $this->user_Session;
    }

    public function get_user_name(){        
        return $this->user_name;
    }

    public function get_user_id(){        
        return $this->user_id;
    }

    private function init(){
        $this->session = new Session();
        $json = $this->getJSONFileConfig();
        $this->sites = $json['sites'];
        $this->defaultSites = $json['default-sites'];
        $this->validateSession();
    }

    private function getJSONFileConfig(){
        $string = file_get_contents('config/access.json');
        $json = json_decode($string, true);
        return $json;
    }

    public function validateSession(){
        if($this->existSession()){
            $rol = $this->get_user_Session_data()->get_role();
            if ($this-> ispublic()){
                $this->redirectDefaultSiteByRole($rol);
            }
            else{
                if($this->isAuthorize($rol)){
                }
                else{
                    $this->redirectDefaultSiteByRole($rol);
                }
            }
        }
        else{
            if($this->ispublic()){
            }
            else{
                header('location: ' . constant('URL') . "");
            }
        }
    }

    public function existSession(){
        if(!$this->session->exists()) return false;
        if ($this->session->get_current_user()== null) return false;
        $user_id = $this->session->get_current_user();
        if($user_id) return true;
        return false;
    }

    public function get_user_Session_data(){
        $id = $this->session->get_current_user();
        $this->user = new UserModel();
        $this->user->get($id);
        return $this->user;
    }

    public function initialize($user){
        $this->session->set_current_user($user->get_id());
        $this->authorizedAccess($user->get_rol());
    }

    private function ispublic(){
        $currentUrl = $this->get_current_page();
        $currentUrl = preg_replace("/\?.*/" , "", $currentUrl);

        for( $i = 0; $i < sizeof($this->sites); $i++){
            if ($currentUrl === $this->sites[$i]['site'] && $this->sites[$i]['access'] === 'public'){
                return true;
            }
        }
        return false;
    }

    private function redirectDefaultSiteByRole($rol){
        $url = "";
        for($i = 0; $i < sizeof($this->sites); $i++ ){
            if($this->sites[$i]['rol'] == $rol){
                $url = "/redes/".$this->sites[$i]['site']; 
                break;
            }
        }
        header('location: '.$url);
    }

    private function isAuthorize($rol){
        $currentUrl = $this->get_current_page();
        $currentUrl = preg_replace("/\?.*/" , "", $currentUrl);

        for( $i = 0; $i < sizeof($this->sites); $i++){
            if ($currentUrl === $this->sites[$i]['site'] && $this->sites[$i]['role'] === $rol){
                return true;
            }
        }
        return false;
    }

    private function get_current_page(){
        $actualink = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actualink);
        return $url[2];
    }

    public function authorizedAccess($rol){
        switch($rol){
            case 'user':
                $this->redirect($this->defaultSites['user']);
            break;
            
            case 'admin':
                $this->redirect($this->defaultSites['admin']);
            break;
        }
    }

    public function logout(){
        $this->session->close_session();
    }
}