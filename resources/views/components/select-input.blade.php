@props(['disabled' => false, 'options' => $options ?? [], 'selected' => $selected ?? null, 'is_include_empty' => $is_include_empty ?? false, 'required' => $required ?? false])

<select @disabled($disabled) @required($required) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
    @if($is_include_empty)
        <option value="">-- Pilih --</option>
    @endif
    @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ $selected === $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>