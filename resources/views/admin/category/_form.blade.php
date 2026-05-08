<div class="mb-3">

    <label>
        Category Name
    </label>

    <input
        type="text"
        name="category_name"
        class="form-control"
        value="{{ old('category_name', $category->category_name ?? '') }}"
    >

</div>

<div class="mb-3">

    <label>
        Parent Category
    </label>

    <select
        name="parent_id"
        class="form-control"
    >

        <option value="">
            Main Category
        </option>

        @foreach($parentCategories as $parent)

            <option
                value="{{ $parent->id }}"
                @selected(
                    old(
                        'parent_id',
                        $category->parent_id ?? ''
                    ) == $parent->id
                )
            >
                {{ $parent->category_name }}
            </option>

        @endforeach

    </select>

</div>