<?php

namespace App\Http\Controllers;

use Validator;
use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('date_time', 'desc')->get();

        return view('course.index', [
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only([
            'title', 'description', 'location', 'date_time', 'seats', 'duration_days', 'instructor_name'
        ]);

        $val = Validator::make($input, [
            'title' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
            'date_time' => 'required',
            'seats' => 'required|numeric',
            'duration_days' => 'required|numeric',
            'instructor_name' => 'required|string'
        ]);

        if ($val->fails()) {
            return back()->with([
                'messageType' => 'danger',
                'message' => 'all fields are required'
            ]);
        }

        $course = Course::create($input);

        return redirect(route('course.show', $course->id))->with([
            'messageType' => 'success',
            'message' => 'Course successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('course.detail', [
            'course' => $course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('course.edit', [
            'course' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $input = $request->only([
            'title', 'description', 'location', 'date_time', 'seats', 'duration_days', 'instructor_name'
        ]);

        $course->update($input);

        return redirect(route('course.show', $course->id))->with([
            'messageType' => 'success',
            'message' => 'Course successfully saved'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }

    public function attendees(Course $course)
    {
        return view('course.attendee', [
            'course' => $course,
            'attendees' => $course->attendees()->orderBy('registration_date', 'asc')->get()
        ]);
    }

    public function ratings(Course $course)
    {
        return view('course.rating', [
            'course' => $course,
            'totalRatings' => $course->attendees()->count()
        ]);
    }
}
