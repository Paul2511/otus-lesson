<div class="bg-white mx-auto my-5 rounded-lg shadow overflow-hidden">
    <div class="m-6">
        <h1 class="text-2xl font-bold text-gray-700">{{ $title }}</h1>
        <p class="text-sm font-base text-gray-500">{{ $description }}</p>
        <div class="my-5">
            {{ $slot }}
        </div>
    </div>
</div>
