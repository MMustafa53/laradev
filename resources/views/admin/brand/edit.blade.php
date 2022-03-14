<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                {{--               Edit Form --}}
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Category Edit
                        </div>
                        <div class="card-body">
                            <form action="{{route('update.brand', ['id'=>$brand->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{$brand->image}}">
                                <div class="form-group">
                                    <label for="category-name">Brand Name</label>
                                    <input type="text" class="form-control" id="brand-name"
                                           aria-describedby="brand-name"
                                           name="name"
                                           value="{{$brand->name}}"
                                           placeholder="Please enter category name ...">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <img src="{{asset($brand->image)}}" style="height: 40px; width: 70px">
                                <div class="form-group">
                                    <label for="brand-image">Brand Image</label>
                                    <input type="file" class="form-control" id="brand-image"
                                           aria-describedby="brand-image"
                                           name="image">
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Edit Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
