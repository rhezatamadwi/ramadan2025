@props(['disabled' => false, 'options' => $options ?? [], 'selected' => $selected ?? null, 'is_include_empty' => $is_include_empty ?? false, 'required' => $required ?? false])

<select @disabled($disabled) @required($required) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-[#007dd9] dark:focus:border-[#007dd9] focus:ring-[#007dd9] dark:focus:ring-[#007dd9] rounded-md shadow-sm']) }}>
    @if($is_include_empty)
        <option value="">-- Pilih --</option>
    @endif
    @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ $selected === $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>