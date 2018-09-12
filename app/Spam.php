<?php


namespace App;


class Spam
{
    public function detect($body)
    {
        $this->detectInvalidKeywords($body);

        return false;
    }

    /**
     * @param $body
     * @throws \Exception
     */
    protected function detectInvalidKeywords($body): void
    {
        $invalidKeywords = [
            'yahoo customer support'
        ];

        foreach ($invalidKeywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new \Exception('Your reply contains spam.');
            }
        }

    }
}