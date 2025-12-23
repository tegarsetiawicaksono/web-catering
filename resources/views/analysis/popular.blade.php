@extends('layouts.app')
@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Menu Paling Banyak Dipesan</h2>
    <div class="bg-white p-6 rounded shadow">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="text-left">Menu</th>
                    <th class="text-left">Jumlah Pesanan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($popularMenus as $menu)
                <tr>
                    <td>{{ $menu->menu_id }}</td>
                    <td>{{ $menu->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
