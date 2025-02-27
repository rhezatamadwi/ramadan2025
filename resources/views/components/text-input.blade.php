@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-[#007dd9] dark:focus:border-[#007dd9] focus:ring-[#007dd9] dark:focus:ring-[#007dd9] rounded-md shadow-sm']) }}>
