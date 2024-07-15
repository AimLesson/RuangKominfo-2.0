<?php
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class WelcomeLayout extends Component
{
    public function render(): View
    {
        return view('components.welcome');
    }
}
