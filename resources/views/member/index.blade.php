@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Manage members</h1>
                </div>

                <table class="mt-3 table table-bordered">
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Photo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td>{{ $member->firstname }}</td>
                                <td>{{ $member->lastname }}</td>
                                <td>{{ $member->email }}</td>
                                <td>
                                    <img src="data:image/png;base64,{{ $member->photo }}" alt="" width="60">
                                </td>
                                <td>
                                    @if ($member->is_activated)
                                        <a href="{{ route('member.status', $member->id) }}?status=0">Deactivate</a>
                                    @else
                                        <a href="{{ route('member.status', $member->id) }}?status=1">Activate</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection