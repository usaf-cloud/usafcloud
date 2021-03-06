# Notes :)

# Laravel Packages

-   Core
    -- Updated for 5.8: DONE
-   Telescope
    -- Status: Done
    -- Updated for 5.8: DONE
-   Horizon
    -- Status: Done
    -- Updated for 5.8: DONE
-   Passport
    -- Status: Started
    -- Updated for 5.8: DONE
    -- Modified for UUIDs on the user_id's
-   Helpers
    -- installed
-   UUID
    -- https://github.com/webpatser/laravel-uuid
    -- https://medium.com/@didin.ahmadi/implement-uuid-on-authentication-built-in-laravel-5-7-e289e6a5a9a5
    -- https://medium.com/@steveazz/setting-up-uuids-in-laravel-5-552412db2088

# User registration

-   locked down to:
    -- usaf.af.mil
    -- usaf.cloud

https://developer.okta.com/blog/2017/06/21/what-the-heck-is-oauth

# Google

-   https://developers.google.com/admin-sdk/directory/v1/guides/delegation
-   https://developers.google.com/admin-sdk/directory/v1/reference/users/insert?authuser=1#auth
-   https://developers.google.com/admin-sdk/directory/v1/reference/
-   https://gist.github.com/fillup/9fbf5ff35b337b27762a
-   https://developers.google.com/admin-sdk/directory/v1/reference/users
-   https://michaelseiler.net/2014/12/16/google-admin-sdk-api-with-php/
-   https://developers.google.com/api-client-library/php/auth/service-accounts#creatinganaccount
-   https://developers.google.com/admin-sdk/directory/v1/guides/authorizing
-   https://developers.google.com/api-client-library/php/auth/service-accounts

# DOD

-   https://dod.defense.gov/Resources/Developer-Info/

# Package Idea

-   Laravel Schema Creator/Viewer

# Laravel Notes

-   Listeners go with Events
-   Observers can go with any Model

# 3D Party Notifs

```php
use App\Models\Auth\User;

Route::get('/test', function() {
	$user = User::first();

	$client = new \GuzzleHttp\Client;

	$response = $client->request('POST', 'http://usaf.test/api/user/notifications', [
	    'headers' => [
	        'Accept' => 'application/json',
	        'Authorization' => 'Bearer '. $user->access_token,
	    ],
	    'form_params' => [
        'title' => 'This is from EPUB',
        'content' => 'this is the body',
        'action_text' => 'Click Me',
        'action_url' => 'http://google.com'
    ]
	]);

	dd(json_decode($response->getBody(), true));

});
```

```php
Route::post('/user/notifications', function (Request $request) {
    $notification = $request->user()->notifications()->create([
        'title' => $request->title,
        'content' => $request->content,
        'action_text' => $request->action_text,
        'action_url' => $request->action_url
    ]);

    return $notification;
});
```
