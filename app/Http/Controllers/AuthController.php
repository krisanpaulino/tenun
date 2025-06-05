<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Pelanggan;
use App\Models\Pembeli;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    function loginPage()
    {
        return view('login');
    }
    public function loginPost(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $data = User::where('email', $email)->first();
        if ($data) { //apakah email tersebut ada atau tidak
            if (Hash::check($password, $data->user_password)) {
                Session::put('user_id', $data->user_id);
                Session::put('email', $data->email);
                Session::put('type', $data->user_type);
                Session::put('login_' . $data->user_type, TRUE);
                switch ($data->user_type) {
                    case 'admin':
                        return redirect(route($data->user_type));
                        break;

                    default:
                        return redirect(url('/'));
                        break;
                }
            } else {
                return redirect('login')->with('danger', 'Password anda salah!');
            }
        } else {
            return redirect('login')->with('danger', 'Email anda salah / Belum terdaftar!');
        }
    }
    function registrasi()
    {
        $provinsi = Province::get();
        $kota = City::get();

        return view('signup', compact('provinsi', 'kota'));
    }
    public function registrasiPost(Request $request)
    {
        //Validasi
        $validated = $request->validate([
            'nama_pelanggan' => 'required',
            'kontak_pelanggan' => 'required',
            'nama_jalan' => 'required',
            'kode_pos' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',

        ]);
        $userdata = $request->validate([
            'email' => 'required|unique:user,email',
            'user_password' => 'required|confirmed:password_confirmation',
            'password_confirmation' => 'required',
        ]);
        unset($userdata['password_confirmation']);
        $userdata['user_type'] = 'pelanggan';
        // dd($userdata['user_password']);
        $userdata['user_password'] = Hash::make($userdata['user_password']);

        $user = new User();
        $user->fill($userdata);

        $user->save();

        $validated['user_id'] = $user->user_id;
        Pelanggan::insert($validated);

        return redirect(route('login'))->with('success', 'Berhasil mendaftar! Silahkan Login');
    }

    public function updateProfil(Request $request)
    {
        //Validasi
        $validated = $request->validate([
            'nama_pelanggan' => 'required',
            'kontak_pelanggan' => 'required',
            'nama_jalan' => 'required',
            'kode_pos' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',

        ]);
        $userdata = $request->validate([
            'email' => ['required', Rule::unique('user', 'email')->ignore(Session::get('user_id'), 'user_id')],
            // 'user_password' => 'required|confirmed:password_confirmation',
            // 'password_confirmation' => 'required',
        ]);
        // unset($userdata['password_confirmation']);
        // $userdata['user_type'] = 'pelanggan';
        // dd($userdata['user_password']);
        // $userdata['user_password'] = Hash::make($userdata['user_password']);

        $user = User::find(Session::get('user_id'));
        $user->fill($userdata);

        $user->save();

        // $validated['user_id'] = $user->user_id;
        $pelanggan = Pelanggan::where('user_id', '=', $user->user_id)->first();
        $pelanggan->update($validated);
        return back()->with('message', "successToast('Berhasil update profil)");
    }

    function logout()
    {
        Session::flush();
        return redirect('/');
    }

    //here
    function gantiPassword(Request $request)
    {
        $user = User::find(Session::get('user_id'));
        // dd($user);
        // dd($request->user_password);
        if (Hash::check($request->current_password, $user->user_password)) {
            $userdata = $request->validate([
                // 'email' => ['required', Rule::unique('user', 'email')->ignore(Session::get('user_id'), 'user_id')],
                'user_password' => 'required|confirmed:password_confirmation',
                'password_confirmation' => 'required'
            ]);
            unset($userdata['password_confirmation']);
            $userdata['user_password'] = Hash::make($userdata['user_password']);

            $user->update($userdata);
            return back()->with('message', "successToast('Berhasil update password)");
        }
        return back()->with('message', "dangerToast('Passowrd Salah!')");
    }
}
