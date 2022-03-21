<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        try{
            return UserResource::collection(User::all());
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'exception' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:8',
                'firstname' => 'string|required',
                'prefix' => 'string',
                'surname' => 'string|required',
                'role' => 'string|exists:roles,name'
            ]);

            if($validator->passes()){
                $uniqueCode = Hash::make($request['email']);

                $user = User::create([
                    'firstname' => $request['firstname'],
                    'prefix' => $request['prefix'],
                    'surname' => $request['surname'],
                    'email' => $request['email'],
                    'password' => bcrypt($request['password']),
                    'role_id' => Role::where('name','=',$request['role'])->first()->id,
                    'uniqueCode' => $uniqueCode
                ]);

                return response()->json([
                    'success' => true,
                    'uniqueCode' => $uniqueCode
                ]);
            }
            else{
                return response()->json([
                    'success' => false,
                    'exception' =>false,
                    'errors' => $validator->errors()
                ]);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'exception' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|exists:users,email',
                'password' => 'required|string',
            ]);

            if ($validator->passes()) {
                $user = User::where('email', '=', $request['email'])->first();
                if (Hash::check($request['password'], $user->password)) {
                    return response()->json(
                        [
                            'success' => true,
                            'role' => $user->role
                        ]
                    );
                } else {
                    return response()->json(
                        [
                            'success' => false,
                            'exception' => false,
                            'errors' => null,
                            'message' => "Incorrect email or password.",
                        ]
                    );
                }
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'exception' => false,
                        'errors' => $validator->errors(),
                    ]
                );
            }
        }
        catch(\Exception $e){
            return response()->json(
                [
                    'success' => false,
                    'exception' => true,
                    'message' => $e->getMessage(),
                ]
            );
        }
    }
}
