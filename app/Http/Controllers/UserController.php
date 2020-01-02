<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /** Get a page of employees
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getEmployees()
    {
        $users = User::whereHas('roles', function (Builder $query) {
            $query->where('id', '!=', '1');
        })->orderBy('created_at','desc')->paginate(500);
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
//        dd($request->roles);
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
    public function  updateEmployee(Request $request, $id){

        $data= $request->validate([
            'name'=>'string',
            'email'=>'email:rfc,dns',
            'phonenumber'=>'string',
            'password'=>'string',
            'roles'=>"array",
            'roles.*'=> 'integer|distinct',
        ]);
//       dd($data);
        $data['password'] = \Hash::make($request->password);
        $data['edited_by'] = $request->user()->id;
        // check for later on https://stackoverflow.com/questions/23968415/laravel-eloquent-attach-vs-sync
//        dd($user = User::find($id)->roles()->sync($request->roles));

        if ($user = User::find($id)){
//            dd($request->roles);
            if (!$request->roles){
                $user = User::find($id)->update($data);
            }else if ($request->roles) {
//                echo 'no roles';
                $user = User::find($id)->update($data);
                $user = User::find($id)->roles()->sync($request->roles);
            }
            return response()->json('Employee Updated Successfully',200);
        }
        return response()->json('Unable to Update Employee ',200);


    }
    public function destroyEmployee(Request $request,User $user)
    {
//            dd($user);
        try {
            $user->update(['edited_by'=>$request->user()->id]);
            $user->delete();

        } catch (\Exception $e) {
            return response()->json('Unable To Delete Employee', 200);
        }


        return response()->json('Employee Deleted Successfully', 200);
    }

    //Get a page of clients
    public function getClients(){
        $clients = User::orderBy('created_at','desc')->whereHas('roles',function (Builder $query){
            $query->where('id','=','1');
        })->orderBy('created_at','desc')->paginate(500);
        return EmployeeResource::collection($clients);

    }
    public function storeClient(Request $request){
//        dd($request);
        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'phonenumber'=>'required',
            'password'=> 'string',
        ]);
        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'phonenumber' => $request->phonenumber,
                'password' => \Hash::make($request->password),
                'created_by'=>$request->user()->id,
            ]
        )->roles()->attach(1);

        return response()->json('Client Created',200);
    }
    public function  updateClient(Request $request, $id){
       $data= $request->validate([
            'name'=>'string',
            'email'=>'email',
            'phonenumber'=>'string',
                'password'=>'string'
        ]);
//       dd($data);
        $data['password'] = \Hash::make($request->password);
        $data['edited_by'] = $request->user()->id;
        if ($user = User::findOrFail($id)->update($data)){
            return response()->json('Client Updated Successfully',200);
        }
        return response()->json('Unable to Update Client ',200);

    }
    public function deleteClient(User $user)
    {
//            dd($user);

        try {
            $user->delete();
        } catch (\Exception $e) {
            return response()->json('Unable To Delete Clients', 200);
        }


        return response()->json('Client Deleted Successfully', 200);
    }

}
