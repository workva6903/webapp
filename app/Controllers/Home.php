<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Home extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email'    => 'required|min_length[8]|max_length[50]|valid_email',
                'password' => 'required|min_length[4]',
            ];
            $error = [
                'password' => [
                    'validateUser' => 'Email or Password is wrong'
                ]
            ];

            if (!$this->validate($rules, $error)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new AdminModel();
                $admin = $model->where('email', $this->request->getVar('email'))
                ->first();
                //    print_r($admin); exit;
                if ($this->verifyMypassword($this->request->getVar('password'), $admin['password'])) {
                    $this->setUserSession($admin); 
                    return redirect()->to('dashboard');
                } else {
                    $data['Flash_message'] = TRUE;
                }
            }
        }
        return view('login', $data);
    }
    public function signup()
    {
        $data = [];
        helper('form');
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'email'    => 'required|min_length[8]|max_length[50]|valid_email|is_unique[admin.email]',
                'password' => 'required|min_length[4]',
                'passconf' => 'required|matches[password]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                // echo 111 ; exit;
                $model = new AdminModel();
                $newData = array(
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password')
                );

                if ($model->save($newData)) {
                    $data['Flash_message'] = TRUE;
                }
            }
        }
        return view('signup', $data);
    }
    private function verifyMypassword($enterpassword, $databasePassword)
    {
        return password_verify($enterpassword, $databasePassword);
    }
    public function dashboard()
    {
        $model = new AdminModel();
        $data['usersdata'] = $model->findAll();
        // print_r($data); 
        return view('dashboard', $data);
    }
    public function editUser()
    {
        // $model = new AdminModel();
        // $data['usersdata'] = $model->findAll();
        // print_r($data); 
        return view('editUser');
    }
    private function setUserSession($admin)
    {
        $data = [
            'id' => $admin['id'],
            'firstname' => $admin['firstname'],
            'lastname' => $admin['lastname'],
            'email' => $admin['email'],
            'isLoggedIn' => true
        ];
        session()->set($data);
        return true;
    }
    public function logout(){
        session()->destroy();
        return redirect()->to('/');
    }
}
