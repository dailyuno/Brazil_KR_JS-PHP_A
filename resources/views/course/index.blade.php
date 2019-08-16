@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Manage Courses</h1>
                    <a href="{{ route('course.create') }}" class="btn btn-success">Create Course</a>
                </div>
                <table class="mt-3 table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            <div class="d-flex justify-content-between align-items-end">
                                <span>Course name</span>
                                <div class="d-flex flex-column">
                                    <a class="small" href="">▲</a>
                                    <a class="small" href="">▼</a>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div class="d-flex justify-content-between align-items-end">
                                <span>Date</span>
                                <div class="d-flex flex-column">
                                    <a class="small" href="">▲</a>
                                    <a class="small" href="">▼</a>
                                </div>
                            </div>
                        </th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td><a href="{{ route('course.show', $course->id) }}">{{ $course->title }}</a></td>
                                <td>{{ $course->date_time }}</td>
                                <td>
                                    <a href="{{ route('course.attendees', $course->id) }}" class="mb-1 btn btn-sm btn-secondary">List Attendees</a>
                                    <a href="{{ route('course.ratings', $course->id) }}" class="mb-1 btn btn-sm btn-secondary">Rating Diagram</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection