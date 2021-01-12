<?php


namespace App\Services\Contexts;


use App\Models\Context;

class ContextStoreService
{
    public static function store(int $word_id, string $prefix, string $value, string $postfix): bool
    {
        $context = new Context();
        $context->word_id = $word_id;
        $context->value = $value;
        $context->prefix = $prefix;
        $context->postfix = $postfix;

        if (!$context->save()) {
            return false;
        }

        return true;
    }
}
