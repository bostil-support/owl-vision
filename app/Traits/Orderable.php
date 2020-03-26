<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Orderable
{
    public function storeOrder(Request $request)
    {
        foreach ($request->input('data') as $item) {

        }
    }

    private function getOrderKeyName() {
        return 'default_order';
    }
}