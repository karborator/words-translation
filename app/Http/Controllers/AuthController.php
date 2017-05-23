<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikolayyotsov
 * Date: 5/20/17
 * Time: 10:45 AM
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 *
 * This calss performs base authentication
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @var array
     */
    protected $validationRules
        = [
            'email'    => 'required|email',
            'password' => 'required|min:4',
        ];

    /**
     * Base authentication
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function authenticate(Request $request)
    {
        $this->validate(
            $request,
            $this->validationRules
        );

        $credentials = $request->only('email', 'password');
        $remember    = $request->has('remember_me');

        if (Auth::attempt($credentials, $remember)
        ) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['Invalid credentials']);
    }
}
