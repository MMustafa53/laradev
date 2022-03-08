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
                            <form action="{{route('update.category', ['id'=>$category->id])}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="category-name">Category Name</label>
                                    <input type="text" class="form-control" id="category-name"
                                           aria-describedby="category-name"
                                           name="name"
                                           value="{{$category->name}}"
                                           placeholder="Please enter category name ...">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Edit Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
