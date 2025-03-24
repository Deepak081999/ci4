<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();

        // Check if user session is active
        if ($session->has('user')) {
            $user = $session->get('user'); // Retrieve user data from the session

            // You can debug or check user data if needed:
            // echo "<pre>"; print_r($userData); echo "</pre>"; exit;

            // Redirect with user data (optional to pass user info in flashdata or redirection)
            return redirect()->to('/song_page')->with('user', $user);
        }

        // If not logged in, show login page
        return view('auth/login');
    }
}
