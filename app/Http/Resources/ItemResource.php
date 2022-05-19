<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'Response';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // return [
            // 'name' => $this->item_name,
        // ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        $error_code = 1;
        $error_status = 'Success';
        $message = 'Ok';

        if (!isset($this)) {
            $error_code = 0;
            $error_status = 'Error';
            $message = 'Item Not Found';
        }

        return [
            "ErrorCode" => $error_code,
            // "ThrottleSeconds" => 0,
            "ErrorStatus" => $error_status,
            "Message" => $message,
            // "MessageData" => {}
        ];
    }
}
