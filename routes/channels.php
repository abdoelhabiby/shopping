<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});



Broadcast::channel('notification-new-order', function ($admin) {

    return $admin->hasPermissionTo('receive_new_orders');

    // return (int) $admin->id === (int) $id;

}, ['guards' => ['admin']]);


// Broadcast::channel('notification-new-order', function ($user) {
//     return $user;
//     return true;
// }, ['guards' => [ 'admin']]);


