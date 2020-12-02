<div>
    <div class="row justify-content-center">
        <h1>Drop-Down Tree View</h1>
    </div>

    <hr class="bg-success">

    <div id="categorySelection">
        <select class="custom-select" name="category" id="category" onchange="myCategory('category')">
            <option value="0"> Select Choice </option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" data-id="{{ $category->title }}"> {{ $category->title }} </option>
            @endforeach
        </select>
    </div>

    <hr class="bg-success">
</div>
