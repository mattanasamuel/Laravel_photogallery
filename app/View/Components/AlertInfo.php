<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class alertInfo extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $message;

    public $display; //così non mostra a prescindere il container se aggiorno
    public function __construct()
    {
        $this->message = session()->get('message');
        $this->type = session()->get('message_code') ? 'info' : 'danger';
        $this->display = session()->has('message') ? 'block' : 'none';

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert-info');
    }
}
