<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'deadline' => $this->deadline,
            'description' => $this->description,
            'objective' => $this->objective,
            'problem' => $this->problem,
            'type' => $this->type,
            'actual' => $this->actual,
            'target_audience' => $this->target_audience,
            'competitors' => $this->competitors,
            'novelty' => $this->novelty,
            'risks' => $this->risks,
            'product_type' => $this->product_type,
            'product_result' => $this->product_result,
            'main_characteristics_product' => $this->main_characteristics_product,
            'resources' => $this->resources,
            'income' => $this->income,
            'promotion_channels' => $this->promotion_channels,
            'partners' => $this->partners,
            'achieved_level' => $this->achieved_level,
            'implementation_phase' => $this->implementation_phase,
        ];
    }
}
