<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

/**
 * Get authenticated user
 *
 * @return Array
 */

if (!function_exists('getAuthUser')) {

  function getAuthUser()
  {
    return [
      'id' => Auth::user()->id,
      'user' => Auth::user()->fullname(),
      'role' => Auth::user()->role,
    ];
  }
}

/**
 * Get authenticated user's window
 *
 * @return Array
 */

if (!function_exists('getAuthUserWindow')) {

  function getAuthUserWindow()
  {
    try {
      return [
        'id' => Auth::user()->window->id,
        'name' => Auth::user()->window->name,
        'services' => Auth::user()->window->services->map(fn ($service) => [
          'id' => $service->id,
          'type' => $service->type
        ]),
      ];
    } catch (Exception $ex) {
      // no window
    }
  }
}
