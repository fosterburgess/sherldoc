<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Pages\SimplePage;

class Home extends SimplePage
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.home';

    protected static ?string $name = 'Hosdfsdfsdme';
    protected static ?string $title = 'Hosdfsdfsdme';

    public function hasTopbar(): bool
    {
        return true;
    }
}
