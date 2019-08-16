@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Attendee List</h1>
                </div>

                <div class="mt-3">
                    <h3>{{ $course->title }}</h3>
                </div>

                <table class="mt-3 table table-bordered">
                    <thead>
                        <tr>
                            <td>First name</td>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Photo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendees as $attendee)
                            <tr>
                                <td>{{ $attendee->member->firstname }}</td>
                                <td>{{ $attendee->member->lastname }}</td>
                                <td>{{ $attendee->member->email }}</td>
                                <td>
                                    <img src="data:image/png;base64,{{ $attendee->member->photo }}" alt="photo" title="photo" width="60">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection