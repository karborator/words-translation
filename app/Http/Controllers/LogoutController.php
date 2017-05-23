<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikolayyotsov
 * Date: 5/22/17
 * Time: 11:24 PM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logout()
    {
        if ($this->isAuthenticated()) {
            Auth::logout();
        }

        return view('welcome');
    }
}
