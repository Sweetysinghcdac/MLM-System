    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white shadow-lg flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-blue-500">
            <span class="text-white">My Dashboard</span>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0H7v6h6v6h6v-6h-6z"></path>
                </svg>
                Home
            </a>

            <a href="{{ route('transactions.create') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 4v16m8-8H4"></path>
                </svg>
                Create Transaction
            </a>

            <a href="{{ route('transactions.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 10h18M3 6h18M3 14h18M3 18h18"></path>
                </svg>
                Transactions
            </a>

            <a href="{{ route('payouts.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 8c-3.314 0-6 1.79-6 4s2.686 4 6 4 6-1.79 6-4-2.686-4-6-4z"></path>
                    <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"></path>
                </svg>
                Payouts
            </a>

            <a href="{{ route('tree') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2v20m-6-6h12"></path>
                </svg>
                Referral Tree
            </a>
        </nav>
    </aside>