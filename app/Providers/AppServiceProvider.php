<?php

namespace App\Providers;

use App\Models\ContentBlock;
use App\Models\SiteSetting;
use App\Models\User;
use App\Policies\CausePolicy;
use App\Policies\UserPolicy;
use App\Services\Payments\PaymentManager;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(\App\Models\Cause::class, CausePolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::define('access-admin', fn (User $user) => $user->isAdmin());

        View::composer('*', function ($view): void {
            if (! Schema::hasTable('site_settings') || ! Schema::hasTable('content_blocks')) {
                return;
            }

            $siteSettings = SiteSetting::query()
                ->orderBy('group')
                ->orderBy('sort_order')
                ->get()
                ->mapWithKeys(fn (SiteSetting $setting) => [$setting->key => $setting->resolved_value])
                ->all();

            $contentBlocks = ContentBlock::query()
                ->orderBy('sort_order')
                ->get()
                ->mapWithKeys(fn (ContentBlock $block) => [$block->key => $block->content])
                ->all();

            $view->with('siteSettings', $siteSettings);
            $view->with('contentBlocks', $contentBlocks);
            $view->with('adminPath', config('croodev.admin_path', 'admin'));
        });
    }
}
