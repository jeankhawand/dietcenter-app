<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /** get all the employees as resources
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getEmployee()
    {
        //get first 5 users
        $users = User::orderBy('created_at','desc')->paginate(5);
        // return collection of users as a resource
        return EmployeeResource::collection($users);
    }

    /**store employees with their roles
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeEmployee(Request $request)
    {
//        dd($request);
        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'phonenumber'=>'required',
            'password'=> 'required',
            'roles'=>"required|array",
            'roles.*'=> 'required|integer|distinct',
        ]);

      User::create(
             [
                 'name' => $request->name,
                 'email' => $request->email,
                 'phonenumber' => $request->phonenumber,
                 'password' => \Hash::make($request->password),
                 'created_by'=>$request->user()->id,
             ]
         )->roles()->attach($request->roles);

        return response()->json('Employee Created',200);
    }
    public function  updateEmployee(Request $request, User $user ){


        $user->update();
        return response()->json('Employee Updated Successfully',200);

    }
    public function destroyEmployee(User $user)
    {
        try {
//            dd($user);
            $user->delete();
        } catch (\Exception $e) {
            return 'error '. ' deleteing';
        }

        return response()->json('Employee Deleted Successfully', 200);
    }
}
