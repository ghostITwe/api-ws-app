<?php

namespace App\Models;

use App\Pipelines\FilterPipeline;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'deadline',
      'description',
      'objective',
      'problem',
      'type',
      'actual',
      'target_audience',
      'competitors',
      'novelty',
      'risks',
      'product_type',
      'product_result',
      'main_characteristics_product',
      'resources',
      'income',
      'promotion_channels',
      'partners',
      'achieved_level',
      'implementation_phase',
    ];

    public function team()
    {
        return $this->belongsToMany(Team::class, 'project_team');
    }

    public function scopeFiltered($query, $request, $filters)
    {
        return app(FilterPipeline::class)
            ->setFilterData($request)
            ->send($query)
            ->through($filters)
            ->thenReturn();
    }
}
