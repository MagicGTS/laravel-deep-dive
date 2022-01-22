<?php

use Illuminate\Support\Arr;

function YamlRouteRegister(array $menu, array &$result, array $parent = [])
{
    if (empty($parent)) {
        $parent = [""];
        $path = "/";
    } else {
        $parent = array_merge($parent, [$menu['reference']]);
        $path = implode('/', $parent);
    }
    $result[] = array_merge(Arr::except($menu, ['items']), ['reference' => $path]);
    if (array_key_exists('items', $menu)) {
        foreach ($menu['items'] as $item) {
            YamlRouteRegister($item, $result, $parent);
        }
    }
}
