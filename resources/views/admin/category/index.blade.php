<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome {{ Auth::user()->name }}
            <b style="float: right">
                Total User Count
                <span class="badge badge-primary">{{count($categories)}}</span>
            </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card-header">
                            All Category
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Sl No</th>
                                <th scope="col">Name</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $cat)
                                <tr>
                                    <th scope="row">{{$cat->id}}</th>
                                    <td>{{$cat->name}}</td>
{{--                                    Eloquent ORM--}}
                                    <td>{{$cat->user->name}}</td>
{{--                                    Query BUilder--}}
{{--                                    <td>{{$cat->name}}</td>--}}
                                    <td>{{\Carbon\Carbon::parse($cat->created_at)->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{route('edit.category', ['id'=>$cat->id])}}" class="btn btn-info">Edit</a>
                                        <a href="{{url('category/delete/'.$cat->id)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$categories->links()}}
                    </div>
                </div>
                {{--                Form --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Category Added
                        </div>
                        <div class="card-body">
                            <form action="{{route('store.category')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="category-name">Category Name</label>
                                    <input type="text" class="form-control" id="category-name"
                                           aria-describedby="category-name"
                                           name="name"
                                           placeholder="Please enter category name ...">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card-header">
                        Trash Category
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Sl No</th>
                            <th scope="col">Name</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trash as $cat)
                            <tr>
                                <th scope="row">{{$cat->id}}</th>
                                <td>{{$cat->name}}</td>
                                {{--                                    Eloquent ORM--}}
                                <td>{{$cat->user->name}}</td>
                                {{--                                    Query BUilder--}}
                                {{--                                    <td>{{$cat->name}}</td>--}}
                                <td>{{\Carbon\Carbon::parse($cat->created_at)->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('restore.category', ['id'=>$cat->id])}}" class="btn btn-info">Restore</a>
                                    <a href="{{route('permanent.category', ['id'=>$cat->id])}}" class="btn btn-danger">Permanent Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$trash->links()}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
