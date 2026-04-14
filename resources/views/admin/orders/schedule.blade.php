<x-admin-layout title="Kalender Jadwal Pesanan">
    <div class="space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kalender Jadwal Pesanan</h1>
                <p class="text-sm text-gray-600">Tandai hari acara dan hari mulai persiapan (H-3).</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                Kembali ke Pesanan
            </a>
        </div>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            <div class="p-4 bg-white border border-yellow-200 rounded-xl lg:col-span-1">
                <p class="text-xs font-semibold tracking-wide text-yellow-700 uppercase">Notifikasi Prepare Hari Ini</p>
                <p class="mt-2 text-3xl font-bold text-yellow-900">{{ $todayPrepareOrders->count() }}</p>
                <p class="mt-1 text-sm text-yellow-800">Pesanan yang harus mulai disiapkan hari ini.</p>

                <div class="mt-4 space-y-2 max-h-64 overflow-y-auto pr-1">
                    @forelse($todayPrepareOrders as $order)
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="block p-3 border border-yellow-200 rounded-lg bg-yellow-50 hover:bg-yellow-100 transition-colors">
                            <p class="text-sm font-semibold text-gray-900">#{{ $order->id }} - {{ $order->customer_name }}</p>
                            <p class="mt-1 text-xs text-gray-600">Acara: {{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }} {{ $order->event_time ?: '' }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">Tidak ada jadwal prepare hari ini.</p>
                    @endforelse
                </div>
            </div>

            <div class="p-4 bg-white border border-gray-200 rounded-xl lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <a href="{{ route('admin.orders.schedule', ['month' => $prevMonth]) }}" class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Sebelumnya
                    </a>
                    <h2 class="text-lg font-semibold text-gray-900">{{ $monthDate->locale('id')->isoFormat('MMMM YYYY') }}</h2>
                    <a href="{{ route('admin.orders.schedule', ['month' => $nextMonth]) }}" class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Berikutnya
                    </a>
                </div>

                <div class="grid gap-2 mb-2" style="grid-template-columns: repeat(7, minmax(0, 1fr));">
                    @foreach(['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $dayName)
                        <div class="py-2 text-xs font-semibold text-center text-gray-600 uppercase">{{ $dayName }}</div>
                    @endforeach
                </div>

                <div class="grid gap-2" style="grid-template-columns: repeat(7, minmax(0, 1fr));">
                    @foreach($calendarDays as $day)
                        @if($day['is_blank'])
                            <div class="min-h-[132px] rounded-lg bg-gray-50"></div>
                        @else
                            @php
                                $date = $day['date'];
                                $isToday = $date->isToday();
                                $eventOrders = $day['event_orders'];
                                $prepareOrders = $day['prepare_orders'];
                                $activeEventCount = collect($eventOrders)->whereIn('status', ['confirmed', 'processing'])->count();
                                $completedEventCount = collect($eventOrders)->where('status', 'completed')->count();
                                $cancelledEventCount = collect($eventOrders)->where('status', 'cancelled')->count();
                            @endphp
                            <div class="min-h-[132px] rounded-lg border p-2 {{ $isToday ? 'border-indigo-400 bg-indigo-50' : 'border-gray-200 bg-white' }}">
                                <div class="mb-2 flex items-center justify-between">
                                    <span class="text-xs font-bold {{ $isToday ? 'text-indigo-700' : 'text-gray-700' }}">{{ $date->day }}</span>
                                    @if($isToday)
                                        <span class="px-1.5 py-0.5 text-[10px] font-semibold text-indigo-700 bg-indigo-100 rounded">Hari Ini</span>
                                    @endif
                                </div>

                                <div class="space-y-1">
                                    @if(count($prepareOrders) > 0)
                                        <div class="px-2 py-1 text-[10px] font-medium text-yellow-900 rounded bg-yellow-100">
                                            Prepare H-3: {{ count($prepareOrders) }}
                                        </div>
                                    @endif

                                    @if($activeEventCount > 0)
                                        <div class="px-2 py-1 text-[10px] font-medium text-blue-900 rounded bg-blue-100">
                                            Terverifikasi: {{ $activeEventCount }}
                                        </div>
                                        @foreach(collect($eventOrders)->whereIn('status', ['confirmed', 'processing'])->take(2) as $eventOrder)
                                            <a href="{{ route('admin.orders.show', $eventOrder->id) }}" class="block truncate px-2 py-1 text-[10px] text-blue-800 bg-blue-50 rounded hover:bg-blue-100">
                                                #{{ $eventOrder->id }} {{ $eventOrder->customer_name }}
                                            </a>
                                        @endforeach
                                    @endif

                                    @if($completedEventCount > 0)
                                        <div class="px-2 py-1 text-[10px] font-medium text-green-900 rounded bg-green-100">
                                            Selesai: {{ $completedEventCount }}
                                        </div>
                                        @foreach(collect($eventOrders)->where('status', 'completed')->take(1) as $eventOrder)
                                            <a href="{{ route('admin.orders.show', $eventOrder->id) }}" class="block truncate px-2 py-1 text-[10px] text-green-800 bg-green-50 rounded hover:bg-green-100">
                                                #{{ $eventOrder->id }} {{ $eventOrder->customer_name }}
                                            </a>
                                        @endforeach
                                    @endif

                                    @if($cancelledEventCount > 0)
                                        <div class="px-2 py-1 text-[10px] font-medium text-red-900 rounded bg-red-100">
                                            Dibatalkan: {{ $cancelledEventCount }}
                                        </div>
                                        @foreach(collect($eventOrders)->where('status', 'cancelled')->take(1) as $eventOrder)
                                            <a href="{{ route('admin.orders.show', $eventOrder->id) }}" class="block truncate px-2 py-1 text-[10px] text-red-800 bg-red-50 rounded hover:bg-red-100">
                                                #{{ $eventOrder->id }} {{ $eventOrder->customer_name }}
                                            </a>
                                        @endforeach
                                    @endif

                                    @if(count($prepareOrders) > 0)
                                        @foreach(collect($prepareOrders)->take(1) as $prepareOrder)
                                            <a href="{{ route('admin.orders.show', $prepareOrder->id) }}" class="block truncate px-2 py-1 text-[10px] text-yellow-800 bg-yellow-50 rounded hover:bg-yellow-100">
                                                Prepare: #{{ $prepareOrder->id }}
                                            </a>
                                        @endforeach
                                    @endif

                                    @if($activeEventCount === 0 && $completedEventCount === 0 && $cancelledEventCount === 0 && count($prepareOrders) === 0)
                                        <div class="px-2 py-1 text-[10px] text-gray-400">-</div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
