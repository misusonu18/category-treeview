<div>
    <ul id="tree1" class="list-group list-group-flush">
        @foreach($children as $child)
            <li class="list-group-item"
                id="nestedChild-{{ $child->id }}"
                data-parentId="{{ $child->parent_id }}"
                data-id="{{ $child->id }}"
            >
                {{ $child->title }}
                <button type="button"
                    wire:click="$emit('getChildCategory', {{ $child->id }})"
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
                    onclick="
                        confirm('Are you sure you want to delete this category and all of its subcategories?') || event.stopImmediatePropagation()
                    "
                    class="btn btn-danger btn-sm"
                >
                    <i class="fa fa-trash"></i>
                </button>

                @if(count($child->child))
                    <livewire:category-child :children="$child->child" :key="$child->id">
                @endif
            </li>
        @endforeach
    </ul>
</div>
