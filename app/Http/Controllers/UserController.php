<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\User;
class UserController extends Controller
{
    public function register(Request $request)
    {
        //'firstname','lastname', 'email','password','phone','business_type','role',
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'phone' => 'required',
            'business_type' => 'required',
            'role' => 'required',
         ];
 
        $this->validate($request, $rules);
 
        try {
                    //'firstname','lastname', 'email','password','phone','business_type','role',

            $hasher = app()->make('hash');
            $firstname = $request->input('firstname');
            $lastname = $request->input('lastname');
            $email = $request->input('email');
            $password = $hasher->make($request->input('password'));
            $phone = $request->input('phone');
            $business_type = $request->input('business_type');
            $role = $request->input('role');
 
            $save = User::create([
                'firstname'=> $firstname,
                'lastname'=> $lastname,
                'email'=> $email,
                'password'=> $password,
                'phone'=> $phone,
                'business_type'=> $business_type,
                'role'=> $role,
                'api_token'=> ''
            ]);
            $res['status'] = true;
            $res['message'] = 'Registration success!';
            return response($res, 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            $res['status'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 500);
        }
    }
 
    public function get_user()
    {
        $user = User::all();
        if ($user) {
              $res['status'] = true;
              $res['message'] = $user;
 
              return response($res);
        }else{
          $res['status'] = false;
          $res['message'] = 'Cannot find user!';
 
          return response($res);
        }
    }
}