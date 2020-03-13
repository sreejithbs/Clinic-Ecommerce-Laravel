<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Define Global Constants
    const LOG_INITIAL_INVENTORY_STOCK = 'Initial Inventory Added';
    const STATUS_INITIAL_INVENTORY_STOCK = 0;

    const LOG_INVENTORY_PURCHASE = 'Inventory Added';
    const STATUS_INVENTORY_PURCHASE = 1;

    const LOG_INVENTORY_TRANSFER = 'Inventory Transferred';
    const STATUS_INVENTORY_TRANSFER = 2;

    const LOG_ECOMMERCE_SALE = 'Ecommerce Sale';
    const STATUS_ECOMMERCE_SALE = 3;

    const LOG_CLINIC_SALE = 'Clinic Sale';
    const STATUS_CLINIC_SALE = 4;
}
