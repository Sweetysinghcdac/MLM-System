<nav class="bg-white shadow">
    <div class="container mx-auto p-4 flex justify-between items-center">
        <div>
            <a href="{{ route('dashboard') }}" class="font-bold text-lg">MLM Demo</a>
        </div>

        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('transactions.create') }}" class="text-sm">Create Transaction</a>
                <a href="{{ route('transactions.index') }}" class="text-sm">Transactions</a>
                <a href="{{ route('payouts.index') }}" class="text-sm">Payouts</a>
                <a href="{{ route('tree') }}" class="text-sm">Referral Tree</a>

                <span class="ml-4 text-sm">Hi, {{ auth()->user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}" class="inline ml-4">
                    @csrf
                    <button type="submit" class="text-sm text-red-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm">Login</a>
                <a href="{{ route('register') }}" class="text-sm">Register</a>
            @endauth
        </div>
    </div>
</nav>
