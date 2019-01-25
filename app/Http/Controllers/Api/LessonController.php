<?php

namespace App\Http\Controllers\Api;

use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(Lesson::query())
            ->addColumn('name', function ($lesson) {
                return $lesson->name;
            })
            ->addColumn('id', function ($lesson) {
                return $lesson->id;
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
        $request->validate([
            'name' => 'required|max:255',
            'user_ids.*' => 'exists:users,id'
        ]);

        $lesson = Lesson::create($request->only('name'));

        $lesson->users()->sync($request->user_ids);

        $lesson->load('users');

        $lesson['actions'] = $this->buildActionButtons($lesson);

        return $lesson->load('users');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'name' => 'required|max:255',
            'user_ids.*' => 'exists:users,id'
        ]);

        $lesson->update($request->only('name'));

        $lesson->users()->sync($request->user_ids);

        $lesson->load('users');

        $lesson['actions'] = $this->buildActionButtons($lesson);

        return $lesson;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        return $lesson->delete();
    }

    protected function buildActionButtons($item)
    {
        return '
            <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-eye"></i>
            </a>
            <a href="#" class="btn btn-sm btn-info">
                <i class="fas fa-edit"></i>
            </a>
            <a href="#" class="btn btn-sm btn-danger">
                <i class="fas fa-times"></i>
            </a>
        ';
    }
}
