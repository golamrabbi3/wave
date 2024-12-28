<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class LogViewer extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.log-viewer';

    public function mount()
    {
        return redirect('/log-viewer');
    }
}
