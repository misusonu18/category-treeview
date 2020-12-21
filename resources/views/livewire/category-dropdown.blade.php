<div>
    <div class="row justify-content-center">
        <h1>Drop-Down Tree View</h1>
    </div>

    <hr class="bg-primary">

    <div class="row" id="parentCategory">
        <select
            class="custom-select"
            name="category"
            id="mainCategory"
            onchange="getChildCategory('mainCategory')"
        >
            <option value="0"> Select Choice </option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" data-id="{{ $category->title }}" >
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="row" id="divChildCategory">
        <!-- Child Category -->
    </div>

    <hr class="bg-success">

</div>
