<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit()
    {
        $user = \Auth::user();

        return view('profile.edit', compact(['user']));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        if (!Hash::check($request->password_old, Auth::user()->password)) {
            return redirect()->back()->withInput($request->all())->withErrors(['password_old' => 'súčasné heslo sa nezhoduje']);
        }

        $this->validate($request, [
            'password' => 'required|min:6'
        ]);

        $user = \Auth::user();
        $user->password = bcrypt($request->password);
        $user->remember_token = null;
        $user->save();

        flash()->success('Úspešne ste zmenili svoje heslo.');

        return redirect()->action('ProfileController@edit');
    }
}
