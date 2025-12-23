@props(['currentStep' => 1])

<div class="mb-8 bg-white p-6 rounded-lg shadow-md">
    <div class="flex items-center justify-between max-w-2xl mx-auto">
        <!-- Step 1: Data Diri -->
        <div class="flex flex-col items-center flex-1">
            <div class="flex items-center justify-center w-12 h-12 rounded-full font-bold text-lg shadow-md
                {{ $currentStep > 1 ? 'bg-green-500 text-white' : ($currentStep == 1 ? 'bg-blue-500 text-white scale-110' : 'bg-gray-200 text-gray-600') }}">
                @if($currentStep > 1)
                ✓
                @else
                1
                @endif
            </div>
            <span class="mt-2 text-xs md:text-sm font-semibold text-center 
                {{ $currentStep > 1 ? 'text-green-500' : ($currentStep == 1 ? 'text-blue-500' : 'text-gray-500') }}">
                Data Diri
            </span>
        </div>

        <!-- Connector 1-2 -->
        <div class="flex-1 h-2 mx-2 rounded-full {{ $currentStep > 1 ? 'bg-green-500' : 'bg-gray-200' }}"></div>

        <!-- Step 2: Detail Acara -->
        <div class="flex flex-col items-center flex-1">
            <div class="flex items-center justify-center w-12 h-12 rounded-full font-bold text-lg shadow-md
                {{ $currentStep > 2 ? 'bg-green-500 text-white' : ($currentStep == 2 ? 'bg-blue-500 text-white scale-110' : 'bg-gray-200 text-gray-600') }}">
                @if($currentStep > 2)
                ✓
                @else
                2
                @endif
            </div>
            <span class="mt-2 text-xs md:text-sm font-semibold text-center 
                {{ $currentStep > 2 ? 'text-green-500' : ($currentStep == 2 ? 'text-blue-500' : 'text-gray-500') }}">
                Detail Acara
            </span>
        </div>

        <!-- Connector 2-3 -->
        <div class="flex-1 h-2 mx-2 rounded-full {{ $currentStep > 2 ? 'bg-green-500' : 'bg-gray-200' }}"></div>

        <!-- Step 3: Pembayaran -->
        <div class="flex flex-col items-center flex-1">
            <div class="flex items-center justify-center w-12 h-12 rounded-full font-bold text-lg shadow-md
                {{ $currentStep > 3 ? 'bg-green-500 text-white' : ($currentStep == 3 ? 'bg-blue-500 text-white scale-110' : 'bg-gray-200 text-gray-600') }}">
                @if($currentStep > 3)
                ✓
                @else
                3
                @endif
            </div>
            <span class="mt-2 text-xs md:text-sm font-semibold text-center 
                {{ $currentStep > 3 ? 'text-green-500' : ($currentStep == 3 ? 'text-blue-500' : 'text-gray-500') }}">
                Pembayaran
            </span>
        </div>
    </div>
</div>