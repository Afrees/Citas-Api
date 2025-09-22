<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FichaMedica extends Model
{
    use HasFactory;
    protected $table = 'fichas_medicas';


    protected $fillable = ['user_id','peso','altura'];

//Listas blancas 

   protected array $allowIncluded  = ['users'];
    protected array $allowFilter = ['id','peso','altura'];
    protected array $allowSort  = ['id','peso ','altura','create_at'];


//Relaciones

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function historiaClinica()
    {
        return $this->hasOne(HistoriaClinica::class);
    }


//Scops

    // Scope para incluir relaciones (eager loading)
    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included'));
        $allowIncluded = collect($this->allowIncluded);

        $filtered = array_filter($relations, fn($rel) => $allowIncluded->contains($rel));

        if (!empty($filtered)) {
            $query->with($filtered);
        }
    }

    // Scope para filtrar
    public function scopeFilter(Builder $query)
    {
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $field => $value) {
            if ($allowFilter->contains($field)) {
                $query->where($field, 'LIKE', '%' . $value . '%');
            }
        }
    }

    // Scope para ordenar
    public function scopeSort(Builder $query)
    {
        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $field) {
            $direction = 'asc';

            if (substr($field, 0, 1) === '-') {
                $direction = 'desc';
                $field = substr($field, 1);
            }

            if ($allowSort->contains($field)) {
                $query->orderBy($field, $direction);
            }
        }
    }

    // Scope para obtener todos o paginar
    public function scopeGetOrPaginate(Builder $query)
    {
        $perPage = intval(request('perPage'));

        return $perPage > 0
            ? $query->paginate($perPage)
            : $query->get();
    }

}
