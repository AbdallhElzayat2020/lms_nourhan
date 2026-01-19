<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Share unread contacts count with all views
        View::composer('dashboard.layouts.sidebar', function ($view) {
            $unreadContactsCount = Contact::where('is_read', false)->count();
            $view->with('unreadContactsCount', $unreadContactsCount);
        });

        // Register SEO Blade directives
        \Blade::directive('seoMeta', function ($expression) {
            return "<?php echo \App\Helpers\SeoHelper::generateMetaTags($expression); ?>";
        });

        \Blade::directive('seoSchema', function ($expression) {
            return "<?php echo \App\Helpers\SeoHelper::generateSchemaMarkup($expression); ?>";
        });

        \Blade::directive('seoTitle', function ($expression) {
            return "<?php echo \App\Helpers\SeoHelper::getPageTitle($expression); ?>";
        });

        // Register Dynamic SEO Blade directives
        \Blade::directive('dynamicSeoMeta', function ($expression) {
            return "<?php echo \App\Helpers\SeoHelper::generateDynamicMetaTags($expression); ?>";
        });

        \Blade::directive('dynamicSeoSchema', function ($expression) {
            return "<?php echo \App\Helpers\SeoHelper::generateDynamicSchemaMarkup($expression); ?>";
        });

        \Blade::directive('dynamicSeoTitle', function ($expression) {
            return "<?php echo \App\Helpers\SeoHelper::getDynamicPageTitle($expression); ?>";
        });
    }
}
