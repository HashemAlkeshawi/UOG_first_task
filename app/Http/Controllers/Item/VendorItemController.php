<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\storeItemFomVendorRequest;
use App\Models\Dashboard\Inventory;
use App\Models\Dashboard\Vendor;
use App\Models\Item\Brand;
use App\Models\Item\Item;
use Illuminate\Http\Request;

class VendorItemController extends Controller
{
    public function create($vendor_id, Request $request)
    {
        $query = Item::query();
        $items = Item::filter($request->all(), $query)->paginate(8);

        $inventories = Inventory::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();

        return view('vendor.members.items', compact('items', 'brands', 'inventories'))->with('filters', $request);
    }

    public function store($vendor_id, storeItemFomVendorRequest $request)
    {

        $vendor = Vendor::find($vendor_id);
        $inventory_id = $request['inventory_id'];
        $item_id =  $request['item_id'];
        $quantity = $request['quantity'];

        $vendor->items()->syncWithoutDetaching([$item_id => ['quantity' => $quantity]]);

        InventoryItemController::storeOne($inventory_id, $request);

        return redirect("inventory/$inventory_id#items");
    }

    public function destroy(Request $request)
    {
        $item_id = $request['item_id'];
        if ($item_id != null) {
            $vendor = Vendor::find($request['vendor_id']);
            $vendor->items()->detach($item_id);
        }
        return redirect()->back();
    }
}