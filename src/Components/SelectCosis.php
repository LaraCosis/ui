<?php

namespace Laracosis\Ui\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class SelectCosis extends Component
{
    // No usar $options nunca
    public $options;

    public $selected;
    public $icon;
    public $placeholder;
    public $searchable;
    public $label;
    public $multiple;
    public $clearable;
    public $remote;
    public $remoteUrl;

    public function __construct(
        $options = [],
        $selected = null,
        $icon = null,
        $placeholder = 'Seleccionar...',
        $searchable = false,
        $label = null,
        $multiple = false,
        $clearable = true,
        $remote = false,
        $remoteUrl = null,
    ) {
        $this->options = $this->normalizeOptions($options);
        $this->selected = $selected;
        $this->icon = $icon;
        $this->placeholder = $placeholder;
        $this->searchable = filter_var($searchable, FILTER_VALIDATE_BOOLEAN);
        $this->label = $label;
        $this->multiple = filter_var($multiple, FILTER_VALIDATE_BOOLEAN);
        $this->clearable = filter_var($clearable, FILTER_VALIDATE_BOOLEAN);
        $this->remote = filter_var($remote, FILTER_VALIDATE_BOOLEAN);
        $this->remoteUrl = $remoteUrl;
    }

    protected function normalizeOptions($options)
    {
        logger()->debug('Normalizing options', ['options' => $options]);
        // Si es Collection, convertir a array
        if ($options instanceof Collection) {
            $options = $options->all();
        }

        // Si ya es array asociativo por id (chequear que las keys no sean 0,1,2,...)
        $isAssociative = false;
        if (is_array($options) && count($options)) {
            $keys = array_keys($options);
            $isAssociative = array_keys($keys) !== $keys; // True si keys no son [0,1,2...]
        }

        if ($isAssociative) {
            return $options;
        }

        // Si es array indexado, transformar a [id => [label...]]
        $normalized = [];
        foreach ($options as $item) {
            if (is_object($item) && method_exists($item, 'getAttribute')) {
                $id    = $item->getAttribute('id') ?? null;
                $label = $item->getAttribute('label') ?? $item->getAttribute('name') ?? $item->getAttribute('value') ?? null;
                $icon  = $item->getAttribute('icon') ?? null;
                $avatar= $item->getAttribute('avatar') ?? null;
                $desc  = $item->getAttribute('description') ?? null;
            } else {
                $id    = $item['id'] ?? null;
                $label = $item['label'] ?? $item['name'] ?? $item['value'] ?? null;
                $icon  = $item['icon'] ?? null;
                $avatar= $item['avatar'] ?? null;
                $desc  = $item['description'] ?? null;
            }
            if ($id !== null) {
                $normalized[(string)$id] = [
                    'label' => $label,
                    'icon' => $icon,
                    'avatar' => $avatar,
                    'description' => $desc,
                ];
            }
        }
        return $normalized;
    }

    public function render()
    {
        return view('laracosis::select-cosis');
    }
}
