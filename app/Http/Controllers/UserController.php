<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Transformers\UserTransformer;
use DateTime;
use Illuminate\Http\Request;
use Spatie\Fractalistic\ArraySerializer;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['profile'])->get();

        // $users = fractal($users, new UserTransformer())
        //     ->parseIncludes(['profile'])
        //     ->serializeWith(new ArraySerializer())
        //     ->toArray();
        
        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('user._create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        
        $user->save();
        
        $profile = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'dob' => $request->input('dob'),
            'address' => $request->input('address')
        ];

        if ($request->file('avatar')) {
            $profile['avatar'] = $this->uploadImage($request);
        }

        $user->profile()->save(
            new Profile($profile)
        );

        return redirect(route('user'));
    }

    public function edit(string $id)
    {
        $user = User::find($id);

        return view('user._edit', ['user' => $user]);
    }

    public function update(string $id, Request $request)
    {
        $user = User::find($id);

        if ($request->input('password')) {
            $request->validate([
                'password' => ['string', 'min:8', 'confirmed']
            ]);

            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        $profile = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'dob' => $request->input('dob'),
            'address' => $request->input('address')
        ];

        if ($request->file('avatar')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $profile['avatar'] = $this->uploadImage($request);
        }

        $user->profile()->save(new Profile($profile));

        return redirect(route('user'));
        
    }

    public function delete(string $id)
    {
        User::find($id)->delete();

        return redirect(route('user'), 200);
    }

    public function getAddress(string $address)
    {
        $profiles = Profile::where(['address', 'LIKE', '%' . $address . '%'])->get();

        $address = $profiles->pluck('address');

        return response()->json($address, 200);
    }

    protected function uploadImage(Request $request)
    {
        $imageName = time() . '.' . $request->avatar->extension();
     
        $request->avatar->move(public_path('images'), $imageName);

        return public_path('images') . $imageName;
    }
}
