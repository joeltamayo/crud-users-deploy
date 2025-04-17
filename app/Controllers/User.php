<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    // Añadir usuario
    public function create()
    {
        $userModel = new UserModel();

        if ($this->request->getMethod() === 'POST') {
            $email = $this->request->getPost('email');

            // Verificar si el correo ya existe
            $existingUser = $userModel->where('email', $email)->first();

            if ($existingUser) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'El correo ya está registrado.');
            }

            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $email,
                'password' => $this->request->getPost('password')
            ];

            $userModel->save($data);

            return redirect()->to(base_url('user/list'))
                ->with('success', 'Usuario creado exitosamente.');
        }

        return view('user/create');
    }

    // Editar usuario
    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to(base_url('user/list'))
                ->with('error', 'Usuario no encontrado.');
        }

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'id' => $id,
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
            ];

            if ($this->request->getPost('password')) {
                $data['password'] = $this->request->getPost('password');
            }

            $userModel->save($data);

            return redirect()->to(base_url('user/list'))
                ->with('success', 'Usuario actualizado correctamente.');
        }

        return view('user/edit', ['user' => $user]);
    }

    // Mostrar usuarios
    public function list()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();
        return view('user/list', ['users' => $users]);
    }

    // Eliminar usuario
    public function delete($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to(base_url('user/list'))->with('error', 'El usuario no existe.');
        }

        $userModel->delete($id);

        return redirect()->to(base_url('user/list'))->with('success', 'Usuario eliminado correctamente.');
    }


    public function details($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Usuario no encontrado');
        }

        return view('user/details', ['user' => $user]);
    }
}
