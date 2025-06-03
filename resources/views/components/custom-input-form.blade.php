@props([
    'label',
    'name',
    'type' => 'text',
    'value' => '',
    'required' => false,
    'placeholder' => '',
    'options' => [],
    'multiple' => false,
    'rows' => 3,
])

<div class="mb-2">
    <label class="block text-sm font-medium mb-2 text-gray-700">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
    @if($type === 'select')
        <select name="{{ $name }}" class="w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-3 px-3 text-sm bg-white transition" {{ $required ? 'required' : '' }} {{ $multiple ? 'multiple' : '' }}>
            <option value="">{{ $placeholder }}</option>
            @foreach($options as $option)
                <option value="{{ $option }}" {{ old($name, $value) == $option ? 'selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select>
    @elseif($type === 'textarea')
        <textarea name="{{ $name }}" class="w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-3 px-3 text-sm bg-white transition resize-none" rows="{{ $rows }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}>{{ old($name, $value) }}</textarea>
    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            class="w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-3 px-3 text-sm bg-white transition"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
        >
    @endif
</div>