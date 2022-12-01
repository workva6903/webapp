<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ImageUploadModel;
use CodeIgniter\Files\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends BaseController
{

    public function index()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            // echo 111; exit;
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
                    return redirect()->to(base_url('/admin/dashboard'));
                } else {
                    $data['Flash_message'] = TRUE;
                }
            }
        }
        return view('admin/login', $data);
    }
    public function dashboard()
    {
        $data = [];
       
        $data['main_content'] = 'admin/dashboard';

        return view('admin/includes/template', $data);
    }
    
    public function product()
    {
        $data = [];
        $data['main_content'] = 'admin/product';
        return view('admin/includes/template', $data);
    }
    public function category()
    {
        $data = [];
        $data['main_content'] = 'admin/category';
        return view('admin/includes/template', $data);
    }


    private function verifyMypassword($enterpassword, $databasePassword)
    {
        return password_verify($enterpassword, $databasePassword);
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
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/admin'));
    }
}
