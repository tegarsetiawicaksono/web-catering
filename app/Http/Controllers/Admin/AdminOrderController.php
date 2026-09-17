<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminOrderController extends Controller
{
    public function dashboard()
    {
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $yearlyRevenue = Order::whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');
        $pendingOrders = Order::where('status', 'pending')->count();
        $recentOrders = Order::latest()->take(10)->get();

        return view('admin.index', compact(
            'todayOrders',
            'yearlyRevenue',
            'pendingOrders',
            'recentOrders'
        ));
    }

    public function index(Request $request)
    {
        $query = Order::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'highest':
                $query->orderBy('total_price', 'desc');
                break;
            case 'lowest':
                $query->orderBy('total_price', 'asc');
                break;
            default:
                $query->latest();
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'street_address' => ['required', 'string'],
            'event_date' => ['required', 'date', 'after_or_equal:today'],
            'event_time' => ['required', 'date_format:H:i'],
            'payment_method' => ['required', 'in:transfer,cash'],
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.name' => ['required', 'string', 'max:255'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
        ]);

        $normalizedItems = collect($validated['items'])
            ->map(function (array $item): array {
                return [
                    'name' => trim((string) $item['name']),
                    'quantity' => (int) $item['quantity'],
                    'price' => (int) $item['price'],
                ];
            })
            ->filter(function (array $item): bool {
                return $item['name'] !== '';
            })
            ->values();

        if ($normalizedItems->isEmpty()) {
            return back()->withErrors([
                'items' => 'Minimal harus ada satu item pesanan.',
            ])->withInput();
        }

        $totalQuantity = $normalizedItems->sum('quantity');
        $totalPrice = $normalizedItems->sum(function (array $item): int {
            return $item['quantity'] * $item['price'];
        });

        $packageName = $normalizedItems->pluck('name')->join(', ');

        $paymentStatus = 'pending';
        $paidAt = null;
        if ($validated['status'] === 'confirmed') {
            $paymentStatus = 'verified';
            $paidAt = Carbon::now();
        }
        if ($validated['status'] === 'completed') {
            $paymentStatus = 'paid';
            $paidAt = Carbon::now();
        }

        $order = Order::create([
            'user_id' => null,
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'province' => $validated['province'],
            'city' => $validated['city'],
            'district' => $validated['district'],
            'street_address' => $validated['street_address'],
            'event_date' => Carbon::parse($validated['event_date'])->toDateString(),
            'event_time' => Carbon::parse($validated['event_time'])->format('H:i:s'),
            'quantity' => $totalQuantity,
            'notes' => $validated['notes'] ?? null,
            'package_name' => $packageName,
            'package_price' => 0,
            'total_price' => $totalPrice,
            'items' => $normalizedItems->all(),
            'status' => $validated['status'],
            'payment_method' => $validated['payment_method'],
            'payment_status' => $paymentStatus,
            'paid_at' => $paidAt,
        ]);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Pesanan manual berhasil dibuat dan siap diproses.');
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function schedule(Request $request)
    {
        $monthInput = (string) $request->get('month', Carbon::now()->format('Y-m'));

        try {
            $monthDate = Carbon::createFromFormat('Y-m', $monthInput)->startOfMonth();
        } catch (\Throwable $e) {
            $monthDate = Carbon::now()->startOfMonth();
        }

        $monthStart = $monthDate->copy()->startOfMonth();
        $monthEnd = $monthDate->copy()->endOfMonth();

        // Include a 3-day buffer before month start so prepare markers stay accurate.
        $queryStart = $monthStart->copy()->subDays(3);
        $queryEnd = $monthEnd->copy();

        $orders = Order::query()
            ->whereNotNull('event_date')
            ->whereIn('status', ['confirmed', 'processing', 'completed', 'cancelled'])
            ->whereDate('event_date', '>=', $queryStart->toDateString())
            ->whereDate('event_date', '<=', $queryEnd->toDateString())
            ->orderBy('event_date')
            ->get();

        $ordersByEventDate = [];
        $ordersByPrepareDate = [];

        foreach ($orders as $order) {
            if (!$order->event_date) {
                continue;
            }

            $eventDate = Carbon::parse($order->event_date);
            $eventKey = $eventDate->toDateString();
            $prepareKey = $eventDate->copy()->subDays(3)->toDateString();

            $ordersByEventDate[$eventKey][] = $order;
            if (in_array($order->status, ['confirmed', 'processing'], true)) {
                $ordersByPrepareDate[$prepareKey][] = $order;
            }
        }

        $firstDayWeekIndex = (int) $monthStart->dayOfWeekIso;
        $leadingBlankDays = $firstDayWeekIndex - 1;
        $daysInMonth = (int) $monthStart->daysInMonth;

        $calendarDays = [];

        for ($i = 0; $i < $leadingBlankDays; $i++) {
            $calendarDays[] = [
                'is_blank' => true,
            ];
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = $monthStart->copy()->day($day);
            $dateKey = $date->toDateString();

            $calendarDays[] = [
                'is_blank' => false,
                'date' => $date,
                'event_orders' => $ordersByEventDate[$dateKey] ?? [],
                'prepare_orders' => $ordersByPrepareDate[$dateKey] ?? [],
            ];
        }

        $today = Carbon::today();
        $todayPrepareOrders = Order::query()
            ->whereNotNull('event_date')
            ->whereIn('status', ['confirmed', 'processing'])
            ->whereDate('event_date', $today->copy()->addDays(3)->toDateString())
            ->orderBy('event_date')
            ->get();

        return view('admin.orders.schedule', [
            'monthDate' => $monthDate,
            'prevMonth' => $monthDate->copy()->subMonth()->format('Y-m'),
            'nextMonth' => $monthDate->copy()->addMonth()->format('Y-m'),
            'calendarDays' => $calendarDays,
            'todayPrepareOrders' => $todayPrepareOrders,
        ]);
    }

    public function updateStatus(Order $order, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $order->update($validated);

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function reports(Request $request)
    {
        $validated = $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $startDate = $request->filled('start_date')
            ? Carbon::parse((string) $validated['start_date'])->startOfDay()
            : Carbon::now()->startOfMonth();
        $endDate = $request->filled('end_date')
            ? Carbon::parse((string) $validated['end_date'])->endOfDay()
            : Carbon::now()->endOfDay();

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $totalRevenue = $orders->sum('total_price');
        $ordersByStatus = $orders->groupBy('status')
            ->map(function ($group) {
                return $group->count();
            });

        $popularPackages = Order::whereBetween('created_at', [$startDate, $endDate])
            ->select('package_name', DB::raw('count(*) as total'))
            ->groupBy('package_name')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('admin.reports', compact(
            'orders',
            'totalRevenue',
            'ordersByStatus',
            'popularPackages',
            'startDate',
            'endDate'
        ));
    }
}
