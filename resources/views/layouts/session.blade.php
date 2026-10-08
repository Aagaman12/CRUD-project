@if (session('success'))
    <div class="fixed top-20 left-0 right-0 z-50
                px-space-md py-space-sm
                bg-green-100 text-green-800
                text-center
                animate-fade-out">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="fixed top-20 left-0 right-0 z-50
                px-space-md py-space-sm
                bg-red-100 text-red-800
                text-center
                animate-fade-out">
        {{ session('error') }}
    </div>
@endif