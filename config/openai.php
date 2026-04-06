<?php

return [
    'api_key' => env('OPENAI_API_KEY', ''),
    'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),
    'api_url' => 'https://api.openai.com/v1/chat/completions',
];