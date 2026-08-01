<?php

namespace JeffersonGoncalves\FilamentCms\Tests;

use Composer\InstalledVersions;
use Filament\Facades\Filament;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use JeffersonGoncalves\Cms\CmsServiceProvider;
use JeffersonGoncalves\FilamentCms\FilamentCmsServiceProvider;
use JeffersonGoncalves\FilamentCms\Testing\InteractsWithCmsFilament;
use JeffersonGoncalves\FilamentCms\Tests\Fixtures\TestPanelProvider;
use JeffersonGoncalves\FilamentCms\Tests\Fixtures\TestUser;
use JeffersonGoncalves\FilamentTranslatable\FilamentTranslatableServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithCmsFilament;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rebindFilamentDataStore();

        Filament::setCurrentPanel(Filament::getDefaultPanel());

        $this->withoutVite();

        $this->actingAs(TestUser::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]));
    }

    protected function getPackageProviders($app): array
    {
        return [
            ...$this->filamentTestProviders(),
            FilamentTranslatableServiceProvider::class,
            MediaLibraryServiceProvider::class,
            CmsServiceProvider::class,
            FilamentCmsServiceProvider::class,
            TestPanelProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
        $app['config']->set('auth.providers.users.model', TestUser::class);
        $app['config']->set('media-library.disk_name', 'local');

        $base = InstalledVersions::getInstallPath('jeffersongoncalves/laravel-cms');

        foreach (['cms-core', 'cms-menu'] as $config) {
            $path = $base.'/config/'.$config.'.php';

            if ($base !== null && file_exists($path)) {
                $app['config']->set($config, require $path);
            }
        }
    }

    protected function defineDatabaseMigrations(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->default('');
            $table->rememberToken();
        });

        Schema::create('media', function (Blueprint $table): void {
            $table->id();
            $table->nullableMorphs('model');
            $table->uuid()->nullable();
            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('disk');
            $table->string('conversions_disk')->nullable();
            $table->unsignedBigInteger('size');
            $table->json('manipulations');
            $table->json('custom_properties');
            $table->json('generated_conversions');
            $table->json('responsive_images');
            $table->unsignedInteger('order_column')->nullable();
            $table->timestamps();
        });

        $this->loadCmsVendorMigrations([
            'create_cms_categories_table',
            'create_cms_tags_table',
            'create_cms_pages_table',
            'create_cms_posts_table',
            'create_cms_categorizables_table',
            'create_cms_taggables_table',
            'create_cms_comments_table',
            'create_cms_revisions_table',
            'create_cms_seo_metas_table',
            'create_cms_menus_table',
            'create_cms_menu_items_table',
        ]);
    }
}
