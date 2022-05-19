<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemCollection;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use File;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item
            ::join('ammunition_types', 'items.ammo_type_code', '=', 'ammunition_types.code')
            ->join('class_types', 'items.class_type_code', '=', 'class_types.code')
            ->join('damage_types', 'items.damage_type_code', '=', 'damage_types.code')
            ->join('item_sub_types', 'items.item_sub_type_code', '=', 'item_sub_types.code')
            ->join('item_types', 'items.item_type_code', '=', 'item_types.code')
            ->join('tier_types', 'items.tier_type_code', '=', 'tier_types.code')
            ->select(
                'items.hash',
                'items.description',
                'items.name as item_name',
                'items.icon',
                'items.has_icon',
                'items.collectible_hash',
                'items.icon_watermark',
                'items.screenshot',
                'items.flavor_text',
                'items.lore_hash',
                'ammunition_types.name as ammo_type_name',
                'class_types.name as class_type_name',
                'damage_types.name as damage_type_name',
                'item_sub_types.name as item_sub_type_name',
                'item_types.name as item_type_name',
                'tier_types.name as tier_type_name',
            )
            ->get();

        return new ItemCollection($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client();
        $hashes = $request->hashes;
        $items = array();

        // $params = [
        //     //If you have any Params Pass here
        // ];

        $headers = [
            'x-api-key' => env('BUNGIE_X_API_KEY')
        ];

        $baseUrl = "https://www.bungie.net/Platform/Destiny2/Manifest/DestinyInventoryItemDefinition/";

        foreach ($hashes as $hash) {
            $url = $baseUrl . $hash;

            $data = $client->request('GET', $url, [
                // 'json' => $params,
                'headers' => $headers,
                'verify'  => false,
            ]);

            $response = json_decode($data->getBody(), true)['Response'];

            $item = new Item();
            $item->createFromJson($response);
            $item->save();

            array_push($items, $item);
        }

        return new ItemCollection($items);
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $hash
     * @return \Illuminate\Http\Response
     */
    public function show($hash)
    {
        $item = Item::where('hash', '=', $hash)->first();

        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $hash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hash)
    {
        $item = Item::where('hash', '=', $hash)->first();

        if (isset($request->hash)) {
            $item->hash = $request->hash;
        }
        if (isset($request->description)) {
            $item->description = $request->description;
        }
        if (isset($request->name)) {
            $item->name = $request->name;
        }
        if (isset($request->icon)) {
            $item->icon = $request->icon;
        }
        if (isset($request->has_icon)) {
            $item->has_icon = $request->has_icon;
        }
        if (isset($request->collectible_hash)) {
            $item->collectible_hash = $request->collectible_hash;
        }
        if (isset($request->icon_watermark)) {
            $item->icon_watermark = $request->icon_watermark;
        }
        if (isset($request->screenshot)) {
            $item->screenshot = $request->screenshot;
        }
        if (isset($request->flavor_text)) {
            $item->flavor_text = $request->flavor_text;
        }
        if (isset($request->lore_hash)) {
            $item->lore_hash = $request->lore_hash;
        }
        if (isset($request->ammo_type_code)) {
            $item->ammo_type_code = $request->ammo_type_code;
        }
        if (isset($request->class_type_code)) {
            $item->class_type_code = $request->class_type_code;
        }
        if (isset($request->damage_type_code)) {
            $item->damage_type_code = $request->damage_type_code;
        }
        if (isset($request->item_sub_type_code)) {
            $item->item_sub_type_code = $request->item_sub_type_code;
        }
        if (isset($request->item_type_code)) {
            $item->item_type_code = $request->item_type_code;
        }
        if (isset($request->tier_type_code)) {
            $item->tier_type_code = $request->tier_type_code;
        }

        $item->save();

        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $hash
     * @return \Illuminate\Http\Response
     */
    public function destroy($hash)
    {
        $item = Item::where('hash', '=', $hash)->first();
        $item->delete();

        return new ItemResource($item);
    }
}
