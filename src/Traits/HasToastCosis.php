<?php

namespace Laracosis\Ui\Traits;

use Illuminate\Support\Str;

trait HasToastCosis
{
    public function toast()
    {
        return new class($this) {
            public function __construct($component) {
                $this->component = $component;
            }
            public function success($title, $message = '', $duration = 4000, $position = null) {
                return $this->send('success', $title, $message, $duration, $position);
            }
            public function error($title, $message = '', $duration = 4000, $position = null) {
                return $this->send('error', $title, $message, $duration, $position);
            }
            public function info($title, $message = '', $duration = 4000, $position = null) {
                return $this->send('info', $title, $message, $duration, $position);
            }
            public function warning($title, $message = '', $duration = 4000, $position = null) {
                return $this->send('warning', $title, $message, $duration, $position);
            }
            protected function send($type, $title, $message, $duration, $position)
            {
                $payload = [
                    'id' => (string) \Illuminate\Support\Str::uuid(),
                    'type' => $type,
                    'title' => $title,
                    'message' => $message,
                    'duration' => $duration,
                ];
                if ($position) $payload['position'] = $position;
                $this->component->dispatch('toast-cosis', $payload);
            }
        };
    }
}
