@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}  </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">DOB</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Category</th>
                            <th scope="col">Organization</th>
                            <th scope="col">Transaction</th>
                            <th scope="col">Method</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($registerMember as $member)
                            <tr>
                                <th scope="row">{{$loop->iteration }}</th>
                                <td>{{$member->first_name}}</td>
                                <td>{{$member->last_name}}</td>
                                <td>{{$member->dob}}</td>
                                <td>{{$member->gender}}</td>
                                <td>{{$member->email}}</td>
                                <td>{{$member->address}}</td>
                                <td>{{$member->category->name}}</td>
                                <td>{{@$member->organizer->name}}</td>
                                <td>{{$member->payment_transaction_id}}</td>
                                <td>{{$member->payment_method}}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <a class="btn btn-warning" href="{{route('member-profile',['memberId' => $member->id, 'memberName' => $member->first_name])}}"> View</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>No data found</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="register-area">
                        <div class="container">

                            <form action="{{route('short-url-store')}}" method="POST">
                                <h3 class="event-name">URL List</h3>
                                @csrf
                                <div class="col-lg-12 col-sm-12 col-12 mt-3 form-group">
                                    <label for="original_url">Original URL</label>
                                    <input type="url" class="form-control" name="original_url" required>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12 mt-3">
                                    <button class="btn btn-primary" type="submit">SHORT URL</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Orginal URL</th>
                            <th scope="col">Short url</th>
                            <th scope="col">Count</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($urlList as $urlValue)
                            <tr>
                            <tr>
                                <td>{{ $urlValue->original_url }}</td>
                                <td><a href="{{ url($urlValue->short_url) }}">{{ url($urlValue->short_url) }}</a></td>
                                <td>{{ $urlValue->count_click }}</td>
                            </tr>

                        @empty
                            <tr>
                                <td>No data found</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
