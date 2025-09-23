# MLM System (Laravel)

A **simplified Multi-Level Marketing (MLM) application** built with Laravel. This project implements a referral system, commission calculations, and transaction processing with user and admin dashboards.

---

## Table of Contents

- [Project Overview](#project-overview)  
- [Features](#features)  
- [Database Structure](#database-structure)  
- [Installation](#installation)  
- [Usage](#usage)  
- [Testing](#testing)  
- [Directory Structure](#directory-structure)  
- [Author](#author)  

---

## Project Overview

This project simulates an MLM platform where:

- Users can **refer other users** via a referral code.  
- A **referral hierarchy** is maintained.  
- Users earn **commissions** from referrals based on simple rules.  
- Transactions can be processed in **two modes**: Direct Blockchain (5% fee) or Manual/Off-chain (2% fee).  
- Admins can manage **withdrawals and user balances**.  
- Users have dashboards to view their **referrals, commissions, and transactions**.  

---

## Features

### User Features

- Registration with optional referral code.  
- Dashboard showing:
  - Total points and balance  
  - Direct referrals  
  - Total commission earned  
  - Transactions history  
- View **referral tree** (horizontal tree view).  
- Request payouts when balance exceeds a threshold.  
- Simulate transactions for testing.  

### Admin Features

- Manage all users and their withdrawal requests.  
- Approve or reject withdrawal requests.  
- View overall referral and commission system.  

---

## Database Structure

**Key Tables:**

- `users`  
  - Stores user information, referral relationships (`referrer_id`), balance, and points.
  - `is_admin` flag determines admin status.

- `properties`  
  - Represents a property in the system (optional for commissions).  

- `transactions`  
  - Records all user transactions with mode and fees.  

- `commissions`  
  - Tracks commissions earned by users.  

- `referral_commissions`  
  - Tracks multi-level commissions based on referrals.  

- `payouts`  
  - Tracks user payout requests.  

- `withdrawal_requests`  
  - Tracks admin-managed withdrawal requests.

---

## Installation

1. Clone the repository:

```bash
git clone <repo_url>
cd mlm-system


composer install
npm install && npm run dev


cp .env.example .env
php artisan key:generate


php artisan migrate:fresh 
php artisan serve


sage

User login: Access the dashboard at /dashboard.

Admin login: Use is_admin user. Admin panel is accessible at /admin/withdrawals.

Referral tree: Navigate to /dashboard/tree to view the hierarchical referral structure.

Transactions: Users can simulate transactions via the "Simulate Transaction" page.

Payouts: Users can request payouts if their balance exceeds a threshold.


app/
├── Models/
│   ├── User.php
│   ├── Transaction.php
│   ├── Commission.php
│   ├── ReferralCommission.php
│   ├── Payout.php
│   └── WithdrawalRequest.php
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   ├── DashboardController.php
│   │   └── Admin/WithdrawalAdminController.php
│   └── Middleware/
│       └── IsAdmin.php
database/
├── factories/
├── migrations/
└── seeders/
resources/
├── views/
│   ├── dashboard/
│   │   ├── tree.blade.php
│   │   ├── _node_collapsible.blade.php
│   └── auth/login.blade.php
routes/
├── web.php

