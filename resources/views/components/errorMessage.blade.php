@if ($errors->any())
            <div class="px-space-md py-space-sm rounded-lg bg-error-container/60 text-error font-label-md text-label-md">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif