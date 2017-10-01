<?php

class Util {

    public static function todo($user, $comment = '')
    {
        throw new TodoException("Todo (@{$user}): {$comment}");
    }
}