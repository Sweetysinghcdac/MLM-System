@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white flex flex-col">

 

    <!-- Hero Section -->
    <section class="flex-1 flex flex-col justify-center items-center text-center px-6 py-16">
        <h1 class="text-5xl font-bold text-gray-800 mb-4">Welcome to MLM System</h1>
        <p class="text-gray-600 mb-6 max-w-2xl">Join our referral network, track your commissions, simulate transactions, and manage payouts effortlessly. Grow your network, earn commissions, and manage your earnings—all in one platform.</p>
        @guest
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Get Started</a>
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Login</a>
        </div>
        @endguest
    </section>

    <!-- Features Section -->
    <section class="bg-gray-50 py-12 px-6">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Platform Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
                <div class="text-4xl mb-4">👥</div>
                <h3 class="font-semibold mb-2">Referral System</h3>
                <p class="text-gray-600">Easily refer friends and track your direct and indirect referrals in a multi-level hierarchy.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
                <div class="text-4xl mb-4">💰</div>
                <h3 class="font-semibold mb-2">Commissions & Balance</h3>
                <p class="text-gray-600">Earn commissions from your referrals and see your total balance in real-time with detailed transaction history.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
                <div class="text-4xl mb-4">📊</div>
                <h3 class="font-semibold mb-2">Dashboard & Payouts</h3>
                <p class="text-gray-600">Monitor your referral tree, manage commissions, and request payouts when your balance reaches the threshold.</p>
            </div>
        </div>
    </section>

    <!-- How it Works Section -->
    <section class="py-12 px-6 max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">How It Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-4xl mb-4">1️⃣</div>
                <h3 class="font-semibold mb-2">Register & Share</h3>
                <p class="text-gray-600">Sign up and get your unique referral code. Share it with friends to start building your network.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-4xl mb-4">2️⃣</div>
                <h3 class="font-semibold mb-2">Earn Commissions</h3>
                <p class="text-gray-600">Each time a referred user performs an action, you earn a commission automatically added to your balance.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-4xl mb-4">3️⃣</div>
                <h3 class="font-semibold mb-2">Track & Withdraw</h3>
                <p class="text-gray-600">View your referral tree and transaction history. Request payouts when your balance is sufficient.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="bg-gray-50 py-12 px-6">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Success Stories</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
                <p class="text-gray-600 mb-4">“I referred my friends and earned commissions quickly. The platform is easy to use!”</p>
                <span class="font-semibold">— Alex P.</span>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
                <p class="text-gray-600 mb-4">“The referral tree visualization helps me track my network and earnings effortlessly.”</p>
                <span class="font-semibold">— Priya S.</span>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
                <p class="text-gray-600 mb-4">“Transactions and payouts are fast and transparent. Highly recommended!”</p>
                <span class="font-semibold">— Ravi K.</span>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-12 px-6 max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Frequently Asked Questions</h2>
        <div class="space-y-4">
            <div class="bg-white p-4 rounded shadow hover:shadow-md transition">
                <h3 class="font-semibold mb-2">How do I get my referral code?</h3>
                <p class="text-gray-600">Once you register, your unique referral code is visible on your dashboard.</p>
            </div>
            <div class="bg-white p-4 rounded shadow hover:shadow-md transition">
                <h3 class="font-semibold mb-2">How are commissions calculated?</h3>
                <p class="text-gray-600">You earn a flat 10% commission for each referral’s points, credited automatically when they perform actions.</p>
            </div>
            <div class="bg-white p-4 rounded shadow hover:shadow-md transition">
                <h3 class="font-semibold mb-2">Can I withdraw my balance anytime?</h3>
                <p class="text-gray-600">Yes, you can request payouts once your balance exceeds the minimum threshold set by the platform.</p>
            </div>
        </div>
    </section>

    <!-- CTA / Register Section -->
    <section class="bg-blue-600 py-12 text-center text-white">
        <h2 class="text-3xl font-bold mb-4">Ready to Start Referring?</h2>
        <p class="mb-6">Sign up today and grow your network while earning commissions!</p>
        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Register Now</a>
    </section>

 

</div>
@endsection
