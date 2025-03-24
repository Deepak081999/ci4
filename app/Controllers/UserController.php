<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('/song_page');
    }

    public function edit()
    {

        $user['user'] = session()->get('user');

        return view('user/edit_user', $user);
    }

    public function update($id)
    {
        $userModel = new UserModel();

        // Retrieve form data
        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        // Handle profile image upload
        $file = $this->request->getFile('profile_picture');

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            // Validate the image size strictly to allow only 200x200 pixels
            $imageInfo = getimagesize($file->getTempName());
            // dd($imageInfo);
            if (($imageInfo[0] < 200 && ! ($imageInfo[0] > 200)) && ($imageInfo[1] < 200) && ! ($imageInfo[1] > 200)) {
                // Move the uploaded file to a directory and save the filename
                $newFileName = $file->getRandomName();
                if ($file->move(ROOTPATH . 'public/uploads/profile_images', $newFileName)) {
                    $data['profile_img'] = $newFileName;
                } else {
                    return redirect()->back()->with('error', 'Failed to upload image. Please try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Image must be exactly 200x200 pixels.');
            }
        }
        // dd($data);
        // Update user details in the database
        $userModel->update($id, $data);

        return redirect()->to('/song_page')->with('success', 'User updated successfully.');
    }

    public function create()
    {
        return view('user/create_user');
    }

    public function store()
    {
        $session   = session();
        $request   = \Config\Services::request();
        $userModel = new UserModel();

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        // Handle profile picture upload
        $file = $request->getFile('profile_picture');

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $imageInfo = getimagesize($file->getTempName());

            // Strict validation for 200x200 pixels
            if (($imageInfo[0] < 200 && ! ($imageInfo[0] > 200)) && ($imageInfo[1] < 200) && ! ($imageInfo[1] > 200)) {
                $newFileName = $file->getRandomName();
                if ($file->move(ROOTPATH . 'public/uploads/profile_images', $newFileName)) {
                    $data['profile_img'] = $newFileName; // Save filename to the database
                } else {
                    $session->setFlashdata('error', 'Failed to upload image. Please try again.');
                    return redirect()->back();
                }
            } else {
                $session->setFlashdata('error', 'Image must be exactly 200x200 pixels.');
                return redirect()->back();
            }
        }

        $userModel->save($data);

        return redirect()->to('/song_page')->with('success', 'User added successfully.');
    }

    // 

}
