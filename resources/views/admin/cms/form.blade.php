<div class="mb-3">
    <label>Title</label>

    <input
        type="text"
        name="title"
        class="form-control"
        value="{{ old('title', $cms->title ?? '') }}"
    >
</div>

<div class="mb-3">
    <label>Content</label>

    <textarea
        name="content"
        id="content"
        class="form-control"
        rows="10"
    >{{ old('content', $cms->content ?? '') }}</textarea>

</div>

<div class="mb-3">
    <label>Meta Title</label>

    <input
        type="text"
        name="meta_title"
        class="form-control"
        value="{{ old('meta_title', $cms->meta_title ?? '') }}"
    >
</div>

<div class="mb-3">
    <label>Meta Description</label>

    <textarea
        name="meta_description"
        class="form-control"
    >{{ old('meta_description', $cms->meta_description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Status</label>

    <select name="is_active" class="form-control">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>
</div>

<button type="submit" class="btn btn-primary">
    Save
</button>