<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ImageUploadModel;
use CodeIgniter\Files\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends BaseController
{

    public function index()
    {
        $data['main_content'] = 'HomePage';

        return view('includes/template', $data);
    }
    public function signin()
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
                    return redirect()->to(base_url());
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
    public function editUser($id)
    {
        $model = new AdminModel();
        if ($this->request->getMethod() == 'post') {
            $newData = array(
                'firstname' => $this->request->getVar('firstname'),
                'lastname' => $this->request->getVar('lastname'),
                'email' => $this->request->getVar('email'),
            );
            if ($model->update($id, $newData)) {
                return redirect()->to('dashboard');
            }
        }
        $data['singleuser'] = $model->where('id', $id)
            ->first();
        // print_r($data); 
        return view('editUser', $data);
    }
    public function upload($id)
    {
        $model = new AdminModel();
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $validationRule = [
                'userfile' => [
                    'label' => 'Image File',
                    'rules' => 'uploaded[userfile]'
                        . '|is_image[userfile]'
                        . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[userfile,100]'
                        . '|max_dims[userfile,1024,768]'
                ]
            ];
            if (!$this->validate($validationRule)) {
                $data['validation'] = $this->validator;
            } else {
                $img = $this->request->getFile('userfile');
                if (!$img->hasMoved()) {
                    $filepath = WRITEPATH . 'uploads/' . $img->store();
                    $uploaded_fileinfo =  new File($filepath);
                    $filename = esc($uploaded_fileinfo->getBasename());
                    $ImageData = array(
                        'image' => $filename,
                    );
                    if ($model->update($id, $ImageData)) {
                        $data['Flash_message'] = TRUE;
                    }
                }
                // $data = ['errors' => 'The file has already been moved.'];
                // return view('upload_form', $data);
            }
        }
        return view('upload_form', $data);
    }
    public function deleteUser($id)
    {
        $model = new AdminModel();
        if ($model->where('id', $id)->delete()) {
            return redirect()->to('dashboard');
        }
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
    public function exportuserdata()
    {
        $admin_model = new AdminModel();
        $fileName = 'employees.xlsx';
        $spreadsheet = new Spreadsheet();
        $employees = $admin_model->findAll();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'First name');
        $sheet->setCellValue('C1', 'Last name');
        $sheet->setCellValue('D1', 'Email');
        $rows = 2;
        foreach ($employees as $val) {
            $sheet->setCellValue('A' . $rows, $val['id']);
            $sheet->setCellValue('B' . $rows, $val['firstname']);
            $sheet->setCellValue('C' . $rows, $val['lastname']);
            $sheet->setCellValue('D' . $rows, $val['email']);
            $rows++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($fileName);
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($fileName));
        flush();
        readfile($fileName);
        exit;
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/signin'));
    }
}
