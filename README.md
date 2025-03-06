# Laravel Smart Database Optimizer

**Laravel Smart Database Optimizer** is a package designed to help developers identify slow queries, suggest optimizations, and recommend indexes to improve database performance.

---

## 🚀 Features

✅ Logs slow queries automatically
✅ Provides CLI commands for analysis
✅ Suggests indexes based on query patterns
✅ Includes middleware for real-time query tracking
✅ Simple installation and configuration

---

## 📦 Installation

### Step 1: Install via Composer

```sh
composer require ashokdevatwal/laravel-smart-db-optimizer
```

### Step 2: Publish Configurations

```sh
php artisan vendor:publish --tag=smartdb-config
```

### Step 3: Run Migrations

```sh
php artisan migrate
```

### Step 4: Add Middleware (Optional)

If you want to log queries globally, add this to your `app/Http/Kernel.php` file:

```php
protected $middleware = [
    \SmartDbOptimizer\Middleware\QueryLogger::class,
];
```

---

## ⚡ Usage

### Analyze Slow Queries

Run the following command to analyze slow queries:

```sh
php artisan smartdb:analyze
```

### Suggest Indexes

Run the command to get index recommendations:

```sh
php artisan smartdb:suggest-indexes
```

### View Logged Queries via API

You can fetch logged queries using:

```
GET /smartdb/queries
```

---

## ⚙️ Configuration

Edit `config/smartdb.php` to set the slow query threshold (default: 100ms):

```php
return [
    'slow_query_threshold' => 100, // Queries taking more than 100ms
];
```

---

## 🛠 Troubleshooting

### Query Logs Table Not Found?

Run migrations again:

```sh
php artisan migrate
```

### Middleware Not Working?

Ensure it's registered in `app/Http/Kernel.php`.

---

## 📜 License

This package is open-source and available under the MIT license.

---

## 💡 Future Enhancements

- UI Dashboard for Query Analysis
- AI-powered Index Suggestions
- Support for Multiple Databases

🚀 Contributions are welcome! Feel free to submit pull requests or open issues.

