<?php

class AuthController extends BaseController {
    protected $lastMessage = [];
    
    
    public function __construct () {
        $this->beforeFilter('guest', ['except'=>['getLogout','getManage','postManage']]);
        $this->beforeFilter('auth', ['only'=>['getManage', 'postManage']]);
    }
    
    public function getIndex() {
        return $this->getManage();
    }
    
    public function getManage($action='index', $id=null) {
        $this->is('admin');
        
        if ($action == 'edit' and is_numeric($id)) {
            $data['user'] = User::find($id);
            $viewname = 'auth.manage_edit';
        }
        else {
            $data['users'] = User::getAll();
            $viewname = 'auth.manage_index';
        }
        
        return View::make($viewname, $data);
    }
    
    public function postManage($action='index', $id=null) {
        $data = [
            'status' => false,
            'message' => 'Data not exists.'
        ];
        
        if ($action == 'edit' and $id !== null) {
            $user = User::find($id);
            if ($user) {
                if ($this->_validate('rules.auth.manage_edit')) {
                    $password = Input::get('password');
                    if ($password) {
                        $user->password = Hash::make($password);
                    }
                    $user->fullname = Input::get('fullname');
                    $user->email = Input::get('email');
                    $user->setStatus(Input::get('status'));
                    $user->setRole(Input::get('role'));
                    
                    try {
                        if ($user->save()) {
                            $data = [
                                'status' => true,
                                'message' => 'Update success.'
                            ];
                        }
                        else {
                            $data['message'] = 'Failed to update data, please try again.';
                        }
                    }
                    catch (Exception $e) {
                        $data['message'] = 'Something wrong while insert into database. #'. time();
                        //echo __FILE__ . ':' . __LINE__ ,'<br/><pre>';var_dump($e->getMessage());die();
                        Log::error($e->getMessage());
                    }
                }
                else {
                    $data['message'] = $this->lastMessage;
                }
            }
        }
        else {
            return $this->getManage();
        }
        
        return Response::json($data);
    }
    
    public function getLogin() {
        return View::make('auth.login');
    }
    public function postLogin() {
        $user = array (
            'username'  => Input::get('username'),
            'password'  => Input::get('password'),
            'status' => 1
        );
        
        $data = ['message'   => 'Login failed'];
        
        if (Auth::attempt($user)) {
            return Redirect::to($this->_getRedirect());
        }
            
        return View::make('auth.login', $data);
    }
    public function getRegister() {
        return View::make('auth.register');
    }
    public function postRegister() {
		if ($this->_validate('rules.auth.register')) {
			$user = new User();
			$user->fill(Input::all());
			$user->password = Hash::make(Input::get('password'));
			$user->role = User::getRoleIdByName('user');
			$user->status = 1;
			
			if ($user->save()) {
                $data  = [
                    'register' => true
                ];
                return View::make('auth.register', $data);
			}
			else {
				$data['message'] = 'Gagal membuat user, silahkan contact admin.';
			}
		}
		else {
			$data['message'] = $this->lastMessage;
		}
		
		return View::make('auth.register', $data);
    }
    public function getLogout() {
        Auth::logout();
        
        return Redirect::to($this->_getRedirect());
    }
    
    private function _getRedirect() {
        $r = Cookie::get('redirect');
        Cookie::forget('redirect');
        
        if (! $r) {
            $r = '/';
        }
        
        return $r;
    }
    
    private function _validate($rulesName) {
        $rules = Config::get($rulesName);
		$valid = Validator::make(Input::all(), $rules['rules'], $rules['message']);
        
        if ($valid->passes()) {
            $this->lastMessage = '';
            return true;
        }
        
        $message = [];
        foreach ($valid->messages()->all() as $m) {
            $message[] = $m;
        }
        
        $this->lastMessage = join(',', $message);
        
        return false;
    }
}
