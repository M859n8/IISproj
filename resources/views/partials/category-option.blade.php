<!-- Файл resources/views/partials/category-option.blade.php -->
<option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
    {{ str_repeat('—', $level) }} {{ $category->name }}
</option>
@if (!empty($category->children))
    @foreach ($category->children as $child)
        @include('partials.category-option', ['category' => $child, 'level' => $level + 1])
    @endforeach
@endif
