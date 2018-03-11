<?php

namespace App\Http\Models;

use Carbon\Carbon;

class EloquentVueTables
{
    public function get($model, array $fields)
    {
        $query = '';
        $limit = 10;
        $ascending = 1;
        $page = 1;
        $byColumn = 0;

        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));

        $data = $model->select($fields);

        if (isset($query) && $query) {
            $data = $byColumn == 1 ?
                $this->filterByColumn($data, $query) :
                $this->filter($data, $query, $fields);
        }

        $count = $data->count();

        $data->limit($limit)
            ->skip($limit * ($page - 1));

        if (isset($orderBy)) :
            $direction = $ascending == 1 ? 'ASC' : 'DESC';
        $data->orderBy($orderBy, $direction);
        endif;

        $results = $data->get()->toArray();
        
        return [
            'data' => $results,
            'count' => $count
        ];
    }

    protected function filterByColumn($data, $queries)
    {
        return $data->where(function ($q) use ($queries) {
            foreach ($queries as $field => $query) :

                if (is_string($query)) {
                $q->where($field, 'LIKE', "%{$query}%");
            } else {
                $start = Carbon::createFromFormat('Y-m-d', $query['start'])->startOfDay();
                $end = Carbon::createFromFormat('Y-m-d', $query['end'])->endOfDay();

                $q->whereBetween($field, [$start, $end]);
            }
            endforeach;
        });
    }

    protected function filter($data, $query, $fields)
    {
        return $data->where(function ($q) use ($query, $fields) {
            foreach ($fields as $index => $field) :
                $method = $index ? 'orWhere' : 'where';
            $q->{$method}($field, 'LIKE', "%{$query}%");
            endforeach;
        });
    }
}