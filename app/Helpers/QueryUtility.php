<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class QueryUtility
{
    public static function performQuery($model, $request, $optionCb)
    {
        try {
            $options = ['where' => []];

            $query = $request->input('query');
            $query = $query ? json_decode($query, true) : [];

            $limit = $query['limit'] ?? 10;
            $page = $query['page'] ?? 1;
            $pagination = $query['pagination'] ?? true;

            $limit = (int)$limit;
            $page = (int)$page - 1;
            $offset = $page * $limit;

            if (isset($query['filter'])) {
                $options['where'] = $query['filter'];
            }

            if (isset($query['search'])) {
                foreach ($query['search'] as $key => $value) {
                    $options['where'][] = [$key, 'LIKE', '%' . $value . '%'];
                }
            }

            if (isset($query['sort'])) {
                $options['order'] = $query['sort'];
            }

            if (isset($query['between'])) {
                foreach ($query['between'] as $key => $value) {
                    if (!is_array($value)) {
                        $options['where'][$key] = $value;
                    } else {
                        $from = $value['from'] ?? null;
                        $to = $value['to'] ?? null;

                        if ($from && $to) {
                            $options['where'][$key] = [$from, $to];
                        } elseif ($from) {
                            $options['where'][$key] = ['>=', $from];
                        } elseif ($to) {
                            $options['where'][$key] = ['<=', $to];
                        }
                    }
                }
            }

            if (is_callable($optionCb)) {
                $optionCb($options);
            }

            $findType = $pagination ? 'paginate' : 'get';

            $results = $model->where($options['where'])
                ->{$findType}($limit, ['*'], 'page', $page + 1);

            if ($pagination) {
                $results->limit = $limit;
                // Assuming the total count is available
                // $results->total = $results->total();
            }

            return [
                "limit"=> $limit
                ,"page"=> $page+1
                ,"total"=> $results->total()
                ,"rows"=> $results->items()
                ,"count"=> $results->count()

            ];

         
        } catch (\Exception $e) {
            return  ResponseHelper::error( $e->getMessage(), 500);
        }
    }
}
