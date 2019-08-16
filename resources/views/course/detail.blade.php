@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>{{ $course->title }}</h1>
                    <div>
                        <a href="{{ route('course.edit', $course->id) }}" class="mb-1 btn btn-warning">Edit</a>
                    </div>
                </div>
            </div>
            <div class="mt-3 col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4><strong>{{ $course->date_time }}</strong>, <span class="text-muted">{{ $course->duration_days }} days long</span></h4>
                        <p>{{ $course->location }} | {{ $course->seats - $course->attendees()->count() }} / {{ $course->seats }} seats available</p>
                        <p>{{ $course->description }}</p>
                        <p>Instructor: <span class="lead">{{ $course->instructor_name }}</span></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection