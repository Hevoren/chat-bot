<?php

use GuzzleHttp\Client;

class Bot
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function answerBot($question)
    {
        $question_str = strval($question);
        $client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
        ]);
        sleep(1);

        $response = $client->request('POST', 'engines/text-davinci-003/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'prompt' => $question_str,
                'max_tokens' => 250,
                'temperature' => 0.5,
                'n' => 1,
                'stream' => false,
                'logprobs' => null,
                'stop' => ['\n']
            ],
        ]);

        $responseBody = json_decode($response->getBody(), true);

        return $responseBody['choices'][0]['text'];
    }
}