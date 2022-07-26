<?php

declare(strict_types=1);

$array = [
    ['id' => 1, 'date' => "12.01.2020", 'name' => "test1"],
    ['id' => 2, 'date' => "02.05.2020", 'name' => "test2"],
    ['id' => 4, 'date' => "08.03.2020", 'name' => "test4"],
    ['id' => 2, 'date' => "11.11.2020", 'name' => "test4"],
    ['id' => 3, 'date' => "06.06.2020", 'name' => "test3"]
];


//1
function getUniqueRows(array $array, string $key): array {
    $keys = [];

    return array_filter(
        $array,
        function ($value) use (&$keys, $key) {
            if (!in_array($value[$key], $keys)) {
                $keys[] = $value[$key];
                return $value;
            }
        }
    );
}

//2
function sortByKey(array &$array, string $key): void {
    usort($array, function($a, $b) use ($key) {
        return $a[$key] <=> $b[$key];
    });
}

//3

function getByKey(array $array, string $key,  $value): array {
   return array_filter($array, function($item) use($key, $value) {
       if ($item[$key] === $value) {
            return $item;
       }
   });
}

//4

function reversePrimaryKey(array $array): array{
    return array_map(
        function ($item) {
            return array_map(
                function ($key, $value) use (&$item) {
                    if ($key === 'id') {
                        unset($item['id']);
                        return "{$value} => {$key}";
                    }
                    return "{$key} => {$value}";
                },
                array_keys($item),
                array_values($item)
            );
        },
        $array
    );
}

var_dump(getByKey($array, 'id', 1));

//5

//SELECT g.id, g.name
//FROM goods g
//INNER JOIN goods_tags tg ON tg.goods_id = g.id
//GROUP BY g.id, g.name
//HAVING COUNT(*) = (SELECT COUNT(*) FROM tags);

//6
//SELECT DISTINCT department_id  FROM evaluations WHERE gender = true AND value > 5;

