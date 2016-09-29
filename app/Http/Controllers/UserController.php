<?php
/**
 * Created by PhpStorm.
 * User: Kaan
 * Date: 9/27/2016
 * Time: 5:16 PM
 */

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function getIndex()
    {
        if (Auth::check()) {

            $tasks = Task::orderBy('created_at', 'decs')->get();
            return redirect()->route('dashboard', ['tasks' => $tasks]);
        }

        return view('frontend.sign');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'signin-email'    => 'required',
            'signin-password' => 'required'
        ]);

        if (!Auth::attempt(['email' => $request['signin-email'], 'password' => $request['signin-password']])) {
            return redirect()->back()->with(['fail' => 'Could not log in']);
        }

        return redirect()->route('dashboard');
    }

    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:100',
            'last_name'  => 'required|max:100',
            'password1'  => 'required|min:4',
            'password2'  => 'required|min:4',
            'email'      => 'required|unique:users'
        ]);

        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $password1 = bcrypt($request['password1']);
        $email = $request['email'];

        if ($request['password1'] != $request['password2']) {
            return redirect()->route('index')->with(['fail' => 'Password doesn\'t matching']);
        }

        $user = new User();
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->password = $password1;
        $user->email = $email;
        $user->save();

        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password1']])) {
            return redirect()->back()->with(['fail' => 'Could not log in']);
        }
        return redirect()->route('dashboard')->with(['success' => 'You signup!']);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

}