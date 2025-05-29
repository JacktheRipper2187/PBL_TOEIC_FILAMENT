<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use App\Filament\Pages\EditProfile;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerUserMenuItems([
                'profile' => UserMenuItem::make()
                    ->label('Edit Profile')
                    ->url(EditProfile::getUrl())
                    ->icon('heroicon-o-user'),
            ]);
        });
        Filament::serving(function () {
            Filament::registerRenderHook(
                'panels::body.end',
                fn(): string => '<footer class="text-center py-4 text-sm text-gray-500">© ' . date('Y') . ' Upa Bahasa Polinema. All rights reserved.</footer>'
            );
        });
    }
}
