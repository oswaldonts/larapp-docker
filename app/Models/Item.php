<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function createFromJson($inventory_item)
    {
        $this->hash = $inventory_item['hash'];
        $this->description = $inventory_item['displayProperties']['description'];
        $this->name = $inventory_item['displayProperties']['name'];
        $this->icon = $inventory_item['displayProperties']['icon'];
        $this->has_icon = $inventory_item['displayProperties']['hasIcon'];
        $this->collectible_hash = $inventory_item['collectibleHash'];
        $this->icon_watermark = $inventory_item['iconWatermark'];
        $this->screenshot = $inventory_item['screenshot'];
        $this->flavor_text = $inventory_item['flavorText'];
        $this->tier_type_code = $inventory_item['inventory']['tierType'];
        $this->ammo_type_code = $inventory_item['equippingBlock']['ammoType'];
        $this->item_type_code = $inventory_item['itemType'];
        $this->item_sub_type_code = $inventory_item['itemSubType'];
        $this->class_type_code = $inventory_item['classType'];
        $this->damage_type_code = $inventory_item['defaultDamageType'];

        if (isset($inventory_item['loreHash'])) {
            $this->lore_hash = $inventory_item['loreHash'];
        }

        // "sockets": {
        //     "socketEntries": [
        //       {
        //         "singleInitialItemHash": 1498917124,
        //         "reusablePlugItems": [
        //           {
        //             "plugItemHash": 4259872956
        //           }
        //         ]
        //       }
        //     ]
        //   }
    }
}
