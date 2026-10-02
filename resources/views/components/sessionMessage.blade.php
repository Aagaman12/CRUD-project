@if(session('error'))
            <div class="mb-space-md rounded-lg bg-red-50 px-space-md py-space-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        @if(session()->has('success'))
            <div
                class="mb-space-md px-space-md py-space-sm rounded-lg bg-primary-container/10 font-label-md text-label-md" style="background-color: #dcfce7;">
                {{ session('success') }}
            </div>
        @endif