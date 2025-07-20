<?php

namespace Laracosis\Ui\Traits;

trait HasToastCosis
{
    public function toast()
    {
        return new class($this) {
            public function __construct($component) {
                $this->component = $component;
            }

            public function success($title, $message = '', $icon = 'heroicon-o-check-circle', $duration = 4000) {
                return $this->send('success', $title, $message, $icon, $duration);
            }

            public function error($title, $message = '', $icon = 'heroicon-o-x-circle', $duration = 4000) {
                return $this->send('error', $title, $message, $icon, $duration);
            }

            public function info($title, $message = '', $icon = 'heroicon-o-information-circle', $duration = 4000) {
                return $this->send('info', $title, $message, $icon, $duration);
            }

            public function warning($title, $message = '', $icon = 'heroicon-o-exclamation', $duration = 4000) {
                return $this->send('warning', $title, $message, $icon, $duration);
            }

            protected function send($type, $title, $message, $icon, $duration)
            {
                $this->component->dispatch('toast-cosis', [
                    'id' => uniqid(),
                    'type' => $type,
                    'title' => $title,
                    'message' => $message,
                    'icon' => $icon,
                    'duration' => $duration,
                ]);
            }
        };
    }
}
