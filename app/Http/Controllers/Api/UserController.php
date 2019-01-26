<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(User::with('lessons')->latest())
            ->addColumn('name', function ($user) {
                return $user->name;
            })
            ->addColumn('email', function ($user) {
                return $user->email;
            })
            ->addColumn('job_title', function ($user) {
                return $user->job_title;
            })
            ->addColumn('id', function ($user) {
                return $user->id;
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'job_title' => 'required|max:255',
            'lesson_ids.*' => 'exists:lessons,id'
        ]);

        $data['password'] = bcrypt(str_random(16));

        return User::create($data)
            ->syncLessons($request->lesson_ids)
            ->load('lessons');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'job_title' => 'required|max:255',
            'lesson_ids.*' => 'exists:lessons,id'
        ]);

        $user->fill($data)->save();

        return $user->syncLessons($request->lesson_ids)->load('lessons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User has been deleted']);
    }
}
