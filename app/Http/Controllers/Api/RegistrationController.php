<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Registration as RegistrationResource;
use App\Registration;
use App\Course;
use App\Member;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $member = Member::whereNotNull('token')->where('token', $request->token)->first();

        return response()->json(RegistrationResource::collection($member->attendees), 200);
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
        $val = Validator::make($request->all(), [
            'course_id' => 'exists:courses,id'
        ]);

        if ($val->fails()) {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }

        $member = Member::whereNotNull('token')->where('token', $request->token)->first();
        $course = Course::find($request->course_id);

        $isRegistration = Registration::where([
            ['course_id', $course->id],
            ['member_id', $member->id]
        ])->first();

        if ($isRegistration) {
            return response()->json([
                'message' => 'Member already registered'
            ], 406);
        }

        if ($course->seats - $course->attendees()->count() < 1) {
            return response()->json([
                'message' => 'No available seat'
            ], 406);
        }

        Registration::create([
            'course_id' => $course->id,
            'member_id' => $member->id,
            'registration_date' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'message' => 'Registration success'
        ], 200);
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
        $member = Member::whereNotNull('token')->where('token', $request->token)->first();
        $course = Course::find($id);

        $val = Validator::make($request->all(), [
            'course_rating' => 'numeric|between:0,2'
        ]);

        $registration = Registration::where([
            ['course_id', $course->id],
            ['member_id', $member->id]
        ])->first();

        if (!$course || $val->fails() || !$registration) {
            return response()->json([
                'message' => 'Bad request'
            ], 400);
        }

        $registration->rate = $request->course_rating;
        $registration->save();

        return response()->json([
            'message' => 'Rating success'
        ], 200);
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
}
