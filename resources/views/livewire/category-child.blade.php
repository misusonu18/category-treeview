<div>
    <ul class="list-group list-group-flush">
        @foreach($children as $child)
            <li class="cursor-pointer list-group-item m-2">
                {{ $child->title }}
                <button type="button"
                    wire:click="$emit('addChildCategory', {{ $child->id }})"
                    class="btn btn-primary btn-sm"
                >
                    <i class="fa fa-plus"></i>
                </button>

                <button type="button"
                    wire:click="$emit('editCategory', {{ $child->id }})"
                    class="btn btn-warning btn-sm"
                >
                    <i class="fa fa-edit"></i>
                </button>

                <button type="button"
                    wire:click="$emit('deleteCategory', {{ $child->id }})"
                    class="btn btn-danger btn-sm"
                >
                    <i class="fa fa-trash"></i>
                </button>

                @if(count($child->child))
                    @livewire('category-child', ['children' => $child->child], key($child->id))
                @endif
            </li>
        @endforeach
    </ul>
</div>
