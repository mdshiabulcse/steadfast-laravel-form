@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th scope="col">Name</th>
                                <td scope="col">{{$member_profile->first_name.' '.$member_profile->last_name}}</td>
                                <td scope="col">
                                    <a class="btn btn-info" href="{{route('member-profile',['memberId' => $member_profile->id, 'memberName' => $member_profile->first_name])}}">Share Profile Short Link</a></td>
                            </tr>
                            <tr>
                                <th scope="col">Age</th>
                                <td scope="col">{{$member_profile->dob}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Mail</th>
                                <td scope="col">{{$member_profile->email}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Category</th>
                                <td scope="col">{{$member_profile->category->name}}</td>
                            </tr>
                            <tr>
                                <th scope="col">Organization</th>
                                <td scope="col">{{$member_profile->organizer->name}}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
