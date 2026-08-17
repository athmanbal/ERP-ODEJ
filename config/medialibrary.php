<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Media Model
     |--------------------------------------------------------------------------
     |
     | By default, the package uses the `Spatie\MediaLibrary\Models\Media` model.
     | If you want to extend this model, you can create your own model and
     | define it here.
     |
     */

'model' => App\Models\Media::class, // Modèle personnalisé

    /*
     |--------------------------------------------------------------------------
     | Default Filesystem Disk
     |--------------------------------------------------------------------------
     |
     | The default disk where your media will be stored. This disk must be
     | defined in `config/filesystems.php`.
     |
     | Supported: "local", "public", "s3", "ftp", "rackspace"
     |
     */

    'disk' => env('MEDIA_DISK', 'public'),

    /*
     |--------------------------------------------------------------------------
     | Media Collection Names
     |--------------------------------------------------------------------------
     |
     | Define all of your media collections here. A media collection is used to
     | group files together that are related to a specific model.
     |
     */

    'collections' => [
        'default' => [
            'disk' => 'public',
            'path' => 'media',
        ],
    ],

    // D'autres paramètres de configuration
];
