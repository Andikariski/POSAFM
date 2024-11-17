<?php

if (!function_exists('formatStatus')) {
    function formatStatus($status)
    {
        return ucwords(str_replace('_', ' ', $status));
    }
}
