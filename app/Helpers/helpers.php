<?php

use Carbon\Carbon;

/**
 * Generate id based on current year
 *
 * @return string
 */

if (!function_exists('generateId')) {

  function generateId()
  {
    $year = Carbon::now()->format('y');
    $id = rand(100000, 999999);

    return $year . '-' . $id;
  }
}
