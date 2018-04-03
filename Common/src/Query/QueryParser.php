<?php

namespace Common\Application\Query;

class QueryParser
{
    public static function parseCriteria(QueryCriteria $queryCriteria, array $correlationFields): QueryCriteria
    {
        $parsedFilter = [];
        $parsedOrdination = [];

        foreach ($queryCriteria->filter() as $filter) {
            if (($position = strpos($filter['field'], "Max")) !== false) {
                $filter['field'] = substr($filter['field'], 0, $position);
                $newFilter = [
                    'field' => $correlationFields[$filter['field']] . "Max",
                    'value' => urldecode($filter['value'])
                ];
            } else if (($position = strpos($filter['field'], "Min")) !== false){
                $filter['field'] = substr($filter['field'], 0, $position);
                $newFilter = [
                    'field' => $correlationFields[$filter['field']] . "Min",
                    'value' => urldecode($filter['value'])
                ];
            } else {
                $newFilter = [
                    'field' => $correlationFields[$filter['field']],
                    'value' => urldecode($filter['value'])
                ];
            }

            array_push($parsedFilter, $newFilter);
        }

        foreach ($queryCriteria->ordination() as $ordination) {
            $newOrdination = ['field' => $correlationFields[$ordination['field']], 'value' => $ordination['value']];
            array_push($parsedOrdination, $newOrdination);
        }

        return new QueryCriteria($parsedFilter, $parsedOrdination, $queryCriteria->page(), $queryCriteria->pageSize());
    }
}