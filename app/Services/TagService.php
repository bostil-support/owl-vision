<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{

    /**
     * @param  string  $title
     *
     * @return \App\Models\Tag
     */
    public function firstOrCreate(string $title): Tag
    {
        /** @var Tag $tag */
        $tag = Tag::query()->firstOrCreate(['title' => $title]);

        return $tag;
    }

    /**
     * @param  array  $items
     *
     * @return array
     */
    public function getIds(array $items): array
    {
        $ids = [];

        foreach ($items as $item) {
            if (is_array($item) && array_key_exists('id', $item)) {
                $ids[] = $item['id'];
            } elseif (is_string($item)) {
                $tag = $this->firstOrCreate($item);
                $ids[] = $tag->id;
            }
        }

        return $ids;
    }
}