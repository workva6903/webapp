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
        // echo "Welcome admin";
        // $data['main_content'] = 'HomePage';

        return view('admin/login', $data);
    }
    public function dashboard()
    {
        $data = [];
        // echo "Welcome admin";
        // $data['main_content'] = 'HomePage';
        $data['main_content'] = 'admin/dashboard';

        return view('admin/includes/template', $data);
    }
    
}
