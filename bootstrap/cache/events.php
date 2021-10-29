<?php return array (
  'TCG\\Voyager\\Providers\\VoyagerEventServiceProvider' => 
  array (
    'TCG\\Voyager\\Events\\BreadAdded' => 
    array (
      0 => 'TCG\\Voyager\\Listeners\\AddBreadMenuItem',
      1 => 'TCG\\Voyager\\Listeners\\AddBreadPermission',
    ),
    'TCG\\Voyager\\Events\\BreadDeleted' => 
    array (
      0 => 'TCG\\Voyager\\Listeners\\DeleteBreadMenuItem',
    ),
    'TCG\\Voyager\\Events\\SettingUpdated' => 
    array (
      0 => 'TCG\\Voyager\\Listeners\\ClearCachedSettingValue',
    ),
  ),
  'App\\Providers\\EventServiceProvider' => 
  array (
    'cart.added' => 
    array (
      0 => 'App\\Listeners\\CartUpdatedListener',
    ),
    'cart.updated' => 
    array (
      0 => 'App\\Listeners\\CartUpdatedListener',
    ),
    'cart.removed' => 
    array (
      0 => 'App\\Listeners\\CartUpdatedListener',
    ),
    'Illuminate\\Auth\\Events\\Registered' => 
    array (
      0 => 'Illuminate\\Auth\\Listeners\\SendEmailVerificationNotification',
    ),
  ),
);