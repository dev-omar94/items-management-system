<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    public function create()
    {
        $selected_items = Item::where('selected', true)->orderBy('updated_at', 'desc')->get();
        $unselected_items = Item::where('selected', false)->orderBy('updated_at', 'desc')->get();
        return view('items', ['selected_items' => $selected_items, 'unselected_items' => $unselected_items]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:App\Models\Item,name']
        ]);

        Item::create($data);
        return redirect()->route('item.create')->with('message', 'Item added successfully');
    }

    public function selectItem(Request $request)
    {
        $request->validate([
            'selectedItemId' => ['required']
        ]);

        $item = Item::find($request->selectedItemId);
        $item->selected = !$item->selected;
        $item->save();
        return redirect()->route('item.create')->with('message', 'Item selected successfully');
    }

    public function unSelectItem(Request $request)
    {
        $request->validate([
            'unselectedItemId' => ['required']
        ]);

        $item = Item::find($request->unselectedItemId);
        $item->selected = !$item->selected;
        $item->save();
        return redirect()->route('item.create')->with('message', 'Item un-selected successfully');
    }
}
