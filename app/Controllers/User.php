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

            // Verificar si el correo ya existe en la base de datos
            $existingUser = $userModel->where('email', $email)->first();

            if ($existingUser) {
                // Redirigir de vuelta con un mensaje de error flash
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'El correo ya está registrado.');
            }

            // Si no existe, procede a guardar el nuevo usuario
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
        $user = $userModel->find($id); // Buscar el usuario por ID

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Usuario no encontrado');
        }

        // Verifica si el formulario fue enviado
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'id' => $id,
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
            ];

            // Si se proporcionó una nueva contraseña, se agrega
            if ($this->request->getPost('password')) {
                $data['password'] = $this->request->getPost('password');
            }

            // Actualiza los datos en la base de datos
            $userModel->save($data);

            // Redirige al listado de usuarios
            return redirect()->to(base_url('user/list'));
        }

        // Muestra la vista de edición con los datos del usuario
        return view('user/edit', ['user' => $user]);
    }

    // Mostar usuarios
    public function list()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll(); // Obtener todos los usuarios
        return view('user/list', ['users' => $users]);
    }

    // Eliminar usuario
    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id); // Eliminar el usuario por ID
        return redirect()->to(base_url('user/list')); // Redirige al listado
    }


    public function details($id)
    {

        $userModel = new UserModel();
        $user = $userModel->find($id); // Buscar el usuario por ID

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Usuario no encontrado');
        }

        // Muestra la vista con los datos
        return view('user/details', ['user' => $user]);
    }
}
