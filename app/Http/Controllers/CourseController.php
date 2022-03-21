<?php

namespace App\Http\Controllers;

use App\Http\Resources\Course as CourseResource;
use App\Http\Resources\User as UserResource;
use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        try{
            return CourseResource::collection(Course::all());
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }

    public function getCourseUsers(Course $course){
        try{
            return UserResource::collection($course->users);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'exception' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function addUser(Request $request, Course $course){
        try {
            $validator = Validator::make($request->all(), [
                'uniqueCode' => 'required|exists:users,uniqueCode',
            ]);

            if($validator->passes()){
                $user = User::where('uniqueCode', '=',$request['uniqueCode'])->first();
                $course->users()->attach($user);

                return response()->json([
                    'success' => true,
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

    public function markUserPresent(Request $request, Course $course){
        try{
            $validator = Validator::make($request->all(), [
                'uniqueCode' => 'required|exists:users,uniqueCode',
            ]);

            if($validator->passes()){
                $user = User::where('uniqueCode', '=',$request['uniqueCode'])->first();
                if($course->users()->where('user_id', $user->id)->exists()){
                    $course->users()->updateExistingPivot($user, ['present' =>true]);
                }

                return response()->json([
                    'success' => true,
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
}
