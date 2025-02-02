<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Firebase Credentials JSON
    |--------------------------------------------------------------------------
    |
    | The path to your Firebase service account JSON file.
    | You can set this value in your .env file.
    |
    */
    'credentials' => storage_path('app/firebase/mylaravelprojectfirebase-firebase-adminsdk-fbsvc-ccfbd4f1dd.json'),

    /*
    |--------------------------------------------------------------------------
    | Firebase Database URL
    |--------------------------------------------------------------------------
    |
    | Your Firebase Realtime Database URL.
    | If you're using Firestore, you might not need this.
    |
    */
    'database_url' => env('FIREBASE_DATABASE_URL', 'https://mylaravelprojectfirebase-default-rtdb.firebaseio.com'),
];
