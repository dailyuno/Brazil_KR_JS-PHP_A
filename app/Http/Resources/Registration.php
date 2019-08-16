<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Registration extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'course_id' => $this->course_id,
            'user_id' => $this->member_id,
            'registration_date' => $this->registration_date,
            'course_rating' => $this->rate
        ];
//        return parent::toArray($request);
    }
}
