@php
    use Illuminate\Support\Str;

    // Define which pages support translation
    $translatablePaths = ['welcome', 'terms', 'privacy', 'dashboard', 'contact'];

    $currentPath = trim(request()->path(), '/'); // e.g. 'ru/dashboard' or 'dashboard' or ''
    $isRu = Str::startsWith($currentPath, 'ru');

    // Remove 'ru/' from start to normalize path
    $normalizedPath = $isRu
        ? trim(Str::after($currentPath, 'ru'), '/')
        : $currentPath;

    // Empty path means root (welcome)
    $normalizedPath = $normalizedPath === '' ? 'welcome' : $normalizedPath;

    // Show toggle only if this page supports both EN and RU versions
    $shouldShowToggle = in_array($normalizedPath, $translatablePaths);

    // Build URL for the opposite language version
    $targetUrl = $isRu
        ? url($normalizedPath === 'welcome' ? '/' : '/' . $normalizedPath)
        : url('ru' . ($normalizedPath === 'welcome' ? '' : '/' . $normalizedPath));
@endphp

@if ($shouldShowToggle)
    <a href="{{ $targetUrl }}"
       class="text-sm font-medium text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">
        {{ $isRu ? 'ENGLISH' : 'РУССКИЙ' }}
    </a>
@endif
