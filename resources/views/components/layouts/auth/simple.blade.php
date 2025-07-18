<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div class="flex w-full items-center justify-center px-4 sm:px-6 md:px-8">
        <div class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl space-y-6">
            <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden"
                wire:navigate>
                <span class="flex h-9 w-9 items-center justify-center rounded-md">
                    <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                </span>
                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>

            {{ $slot }}
        </div>
    </div>
    @fluxScripts
</body>

</html>