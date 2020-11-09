<div>
    <div class="row justify-content-center">
        <h1>Tree View</h1>
    </div>

    <hr class="bg-success">

    <div id="categorySelection">
        <select class="custom-select" id="category" onchange="myCategory('category')">
            <option value="0"> Select Choice </option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"> {{ $category->title }} </option>
            @endforeach
        </select>
    </div>


    <hr class="bg-success">

     <div class="row justify-content-end">
        <div class="col-8 pb-0">
            @if (session()->has('message'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-6">
            <button wire:click="addCategory" class="btn btn-primary">Add Category</button>

            <ul id="tree" class="list-group list-group-flush">
                @foreach($categories as $category)
                    <li class="list-group-item">
                        {{ $category->title }}
                        <button type="button"
                            wire:click="$emit('getChildCategory', {{ $category->id }})"
                            class="btn btn-primary btn-sm"
                        >
                            <i class="fa fa-plus"></i>
                        </button>

                        <button type="button"
                            wire:click="$emit('editCategory', {{ $category->id }})"
                            class="btn btn-warning btn-sm"
                        >
                            <i class="fa fa-edit"></i>
                        </button>

                        <button type="button"
                            wire:click="$emit('deleteCategory',{{ $category->id }})"
                            onclick="
                                confirm('Are you sure you want to delete this category and all of its subcategories?') || event.stopImmediatePropagation()
                            "
                            class="btn btn-danger btn-sm"
                        >
                            <i class="fa fa-trash"></i>
                        </button>

                        @if(count($category->child))
                            <livewire:category-child :children="$category->child" :key="$category->id">
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-6">
            @if($editCategory)
                <form wire:submit.prevent="updateCategory">
                    <div class="form-group">
                        <label>Update Category Name:</label>
                        <input type="text" class="form-control" wire:model="title">
                    </div>
                    @error('title') <span class="error">{{ $message }}</span> @enderror

                    <div class="form-group">
                        <input type="submit" class="btn btn-warning btn-block rounded"
                            value="Edit"
                        >
                    </div>
                </form>
            @endif

            @if($createCategory)
                <form wire:submit.prevent="{{ $categoryId ? "addChildCategory($categoryId)" : "addCategory" }}">
                    <div class="form-group">
                        <label>{{ $categoryId ? "Add Child Category" : "Add Category" }}</label>
                        <input type="text" class="form-control" wire:model="title">
                    </div>
                    @error('title') <span class="error">{{ $message }}</span> @enderror

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block rounded" value="Add">
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@section('footer')
<script>

</script>
@endsection
