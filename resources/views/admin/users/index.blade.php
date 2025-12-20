@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users')

@section('content')
<style>
    .users-table {
        background-color: var(--light-beige);
        border: 2px solid var(--gold-outline);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .table-header-bg {
        background-color: var(--warm-beige);
        border-bottom: 2px solid var(--gold-outline);
    }
</style>

<div class="users-table">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y" style="border-color: var(--gold-outline);">
            <thead class="table-header-bg">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Registered</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Total Orders</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--text-dark); border-bottom: 2px solid var(--gold-outline);">Total Spent</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="background-color: var(--light-beige); border-color: var(--gold-outline);">
                @forelse($users as $user)
                    <tr class="hover:bg-opacity-50" style="background-color: rgba(255, 255, 255, 0.3);">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold" style="color: var(--text-dark);">{{ $user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: var(--text-light);">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: var(--text-light);">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full border-2" style="border-color: var(--gold); background-color: rgba(212, 175, 55, 0.1); color: var(--gold);">
                                {{ $user->orders->count() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--gold);">
                            ₱{{ number_format($user->orders->where('status', '!=', 'cancelled')->sum('total_amount'), 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center" style="color: var(--text-light);">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>
@endsection

