<div>
    <h1>Tree View</h1>

    <button wire:click="addCategory(0)" class="btn btn-primary">Add Category</button>

    <ul id="tree" class="list-group list-group-flush m-1">
        @foreach($categories as $category)
            <li class="cursor-pointer list-group-item">
                {{ $category->title }}
                <button type="button" wire:click="$emit('addChildCategory', {{ $category->id }})" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>
                </button>

                <button type="button" wire:click="$emit('editCategory', {{ $category->id }})" class="btn btn-warning btn-sm">
                    <i class="fa fa-edit"></i>
                </button>

                <button type="button" wire:click="$emit('deleteCategory',{{ $category->id }})" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i>
                </button>

                @if(count($category->child))
                    @livewire('category-child', ['children' => $category->child], key($category->id))
                @endif
            </li>
        @endforeach
    </ul>
    <hr>
    @if($editCategory)
        <div class="row">
            <div class="col-4">
                <form wire:submit.prevent="updateCategory">
                    <div class="form-group">
                        <label>Category Name:</label>
                        <input type="text" class="form-control" wire:model="title">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-warning btn-block rounded"
                            value="Edit"
                        >
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if($createCategory)
        <div class="row">
            <div class="col-4">
                <form wire:submit.prevent=
                    addChildCategory({{ $categoryId }}) ? "addChildCategory({{ $categoryId }})" : "addCategory(0)"
                >
                    <div class="form-group">
                        <label>{{ $categoryId ? "Add Child Category" : "Add Category" }}</label>
                        <input type="text" class="form-control" wire:model="title">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block rounded" value="Add">
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
