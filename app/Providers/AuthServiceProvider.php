<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Author;
use App\Models\Book;
use App\Models\Copy;
use App\Policies\AuthorPolicy;
use App\Policies\BookPolicy;
use App\Policies\CopyPolicy;
use App\Policies\LoanPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Author::class => AuthorPolicy::class,
        Book::class => BookPolicy::class,
        Copy::class => CopyPolicy::class,
        LoanPolicy::class => LoanPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
