@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6">
                <h1>Create Course</h1>
                <form action="{{ route('course.update', $course->id) }}" method="POST">
                    @csrf

                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">
                        <label for="name">Course name</label>
                        <input id="name" placeholder="Course name" name="title" type="text" class="form-control" value="{{ $course->title }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea rows="5" id="description" name="description" placeholder="Course description" type="text"
                                  class="form-control">{{ $course->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input id="location" name="location" placeholder="Course location" type="text" class="form-control" value="{{ $course->location }}">
                    </div>
                    <div class="form-group">
                        <label for="datetime">Starting Date & Time</label>
                        <input id="datetime" name="date_time" placeholder="Course date" type="datetime-local"
                               class="form-control" value="{{ str_replace(' ', 'T', $course->date_time) }}">
                    </div>
                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input id="capacity" name="seats" placeholder="Course capacity" type="number"
                               class="form-control" value="{{ $course->seats }}">
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration days</label>
                        <input id="duration" name="duration_days" placeholder="Course duration" type="number"
                               class="form-control" value="{{ $course->duration_days }}">
                    </div>
                    <div class="form-group">
                        <label for="instructor">Instructor's name</label>
                        <input id="instructor" name="instructor_name" placeholder="Course instructor's name" type="text"
                               class="form-control" value="{{ $course->instructor_name }}">
                    </div>
                    <button class="btn btn-success" type="submit">Save Course</button>
                </form>
            </div>
        </div>
    </div>
@endsection