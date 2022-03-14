<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome {{ Auth::user()->name }}
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
                            @foreach($brand as $brn)
                                <tr>
                                    <th scope="row">{{$brn->id}}</th>
                                    <td>{{$brn->name}}</td>
                                    <td><img src="{{asset($brn->image)}}" style="height: 40px; width: 70px"> </td>
                                    <td>{{\Carbon\Carbon::parse($brn->created_at)->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{route('edit.brand', ['id'=>$brn->id])}}" class="btn btn-info">Edit</a>
                                        <a href="{{url('brand/delete/'.$brn->id)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$brand->links()}}
                    </div>
                </div>
                {{--                Form --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Category Added
                        </div>
                        <div class="card-body">
                            <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="brand-name">Brand Name</label>
                                    <input type="text" class="form-control" id="brand-name"
                                           aria-describedby="brand-name"
                                           name="name"
                                           placeholder="Please enter brand name ...">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand-image">Brand Image</label>
                                    <input type="file" class="form-control" id="brand-image"
                                           aria-describedby="brand-image"
                                           name="image">
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
