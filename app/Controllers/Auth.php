<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{

    public function __construct() {
        helper(['url', 'form']);
    }

    public function index()
    {
        $data = [];
        helper(['form']);

        if($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[4]|max_length[100]|valid_email',
                'password' => 'required|min_length[4]|max_length[50]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Email or Password don\'t match'
                ]
            ];

            if(! $this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            }
            else {
                $model = new UserModel();
                $user = $model->where('email', $this->request->getVar('email'))->first();
                
                $this->setUserSession($user);

                return redirect()->to('/home');
            }
        }
        $data['title'] = 'Login';
        echo view('templates/header', $data);
        echo view('auth/login');
        echo view('templates/footer');
    }

    private function setUserSession($user) {
        $data = [
            'id' => $user['id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

    public function register()
    {
        $data = [];
        helper(['form']);

        if($this->request->getMethod() == 'post') {
            $rules = [
                'first_name' => 'required|min_length[2]|max_length[50]',
                'last_name' => 'required|min_length[2]|max_length[50]',
                'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[4]|max_length[50]',
                'confirmPassword' => 'matches[password]'
            ];
            if(! $this->validate($rules)) {
                $data['validation'] = $this->validator;
            }
            else {
                $model = new UserModel();

                $newData = [
                    'first_name' => $this->request->getVar('first_name'),
                    'last_name' => $this->request->getVar('last_name'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                ];
                $model->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Successful Registration');
                return redirect()->to('/');
            }
        }
        $data['title'] = 'Registration';
        echo view('templates/header', $data);
        echo view('auth/register');
        echo view('templates/footer');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/');
    }

}
