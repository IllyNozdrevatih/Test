<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Area;

class AreasComposer
{
    public function compose(View $view){
        $view->with('areas',Area::all());
    }
}