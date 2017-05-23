<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikolayyotsov
 * Date: 5/20/17
 * Time: 11:07 AM
 */

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        if (!$this->isAuthenticated()) {
            return back();
        }

        return view('dashboard');
    }
}
