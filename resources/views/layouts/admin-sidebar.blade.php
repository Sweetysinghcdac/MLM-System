<aside class="w-64 bg-gray-900 text-white min-h-screen">
    <div class="p-4 font-bold text-lg border-b border-gray-700">
        Admin Panel
    </div>
    <nav class="p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-700">
            Dashboard
        </a>
        <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">
            Users
        </a>
        <a href="{{ route('admin.properties.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">
            Properties
        </a>
        <a href="{{ route('admin.transactions.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">
            Transactions
        </a>
        <a href="{{ route('admin.payouts.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">
            Payouts
        </a>
        <a href="{{ route('admin.withdrawals.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">
            Withdrawals
        </a>
        <a href="{{ route('admin.referrals.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">
            Referrals
        </a>
    </nav>
</aside>
