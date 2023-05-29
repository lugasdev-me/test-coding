<?php

namespace App\Http\Livewire;

use App\Models\Order as ModelsOrder;
use Livewire\Component;

class Order extends Component
{


    public function render()
    {
        return view('livewire.order', [
            'orders' => ModelsOrder::all(),
        ]);
    }
}
