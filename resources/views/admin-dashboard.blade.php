@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
                                            <label class="btn btn-secondary active">
                                                <a type="radio" name="options" id="option1"> View</a>
                                            </label>
                                            <label class="btn btn-secondary">
                                                <a type="radio" name="options"> Edit</a>
                                            </label>
                                            <label class="btn btn-secondary">
                                                <a type="radio" name="options"> Delete </a>
                                            </label>
                                        </div>
                                    </td>
                                <tr>
                                    @empty
                                        <p>No Data found.</p>
                                    @endforelse

                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <br><br>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="register-area">
                            <div class="container">
                                <form id="memberCategoryForm" class="register-form-area" method="POST"
                                      action="{{route('category-store')}}">
                                    @csrf
                                    <h3 class="event-name">Category</h3>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="category_name">Category Name*</label>
                                                <input type="text" name="category_name" id="category_name"
                                                       class="form-control" placeholder="Category Name"
                                                       value="{{ old('category_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="category_description">Description*</label>
                                                <input type="text" name="category_description" id="category_description"
                                                       class="form-control" placeholder="Description"
                                                       value="{{ old('category_description') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="category_status">Status*</label>
                                                <select id="category_status" name="category_status" class="form-select">
                                                    <option selected disabled>Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-12 mt-3">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <h4>Category List</h4>
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($category as $catValue)
                                <tr>
                                    <th scope="row">{{$loop->iteration }}</th>
                                    <td>{{$catValue->name}}</td>
                                    <td>{{$catValue->description}}</td>
                                    <td>{{$catValue->status == 1 ? 'Active':'Inactive'}}</td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-secondary active">
                                                <a type="radio" name="options" id="option1"> View</a>
                                            </label>
                                            <label class="btn btn-secondary">
                                                <a type="radio" name="options"> Edit</a>
                                            </label>
                                            <label class="btn btn-secondary">
                                                <a type="radio" name="options"> Delete </a>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <p>No Data found.</p>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="register-area">
                            <div class="container">
                                <form id="register-form" class="register-form-area" method="POST"
                                      action="{{route('organizer-store')}}">
                                    @csrf
                                    <h3 class="event-name">Organizer</h3>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="organizer_name">Organizer Name*</label>
                                                <input type="text" name="organizer_name" id="organizer_name"
                                                       class="form-control" placeholder="Organizer Name"
                                                       value="{{ old('organizer_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="organizer_description">Description*</label>
                                                <input type="text" name="organizer_description"
                                                       id="organizer_description" class="form-control"
                                                       placeholder="Description"
                                                       value="{{ old('organizer_description') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="organizer_status">Status*</label>
                                                <select id="organizer_status" name="organizer_status"
                                                        class="form-select">
                                                    <option selected disabled>Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-12 mt-3">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <h4>Organization List</h4>
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($organizer as $orgValue)
                                <tr>
                                    <th scope="row">{{$loop->iteration }}</th>
                                    <td>{{$orgValue->name}}</td>
                                    <td>{{$orgValue->description}}</td>
                                    <td>{{$orgValue->status == 1 ? 'Active':'Inactive'}}</td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-secondary active">
                                                <a type="radio" name="options" id="option1"> View</a>
                                            </label>
                                            <label class="btn btn-secondary">
                                                <a type="radio" name="options"> Edit</a>
                                            </label>
                                            <label class="btn btn-secondary">
                                                <a type="radio" name="options"> Delete </a>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <p>No Data found.</p>
                            @endforelse


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
