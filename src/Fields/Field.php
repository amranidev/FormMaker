<?php

namespace Grafite\FormMaker\Fields;

class Field
{
    protected static function getType()
    {
        return 'string';
    }

    protected static function getOptions()
    {
        return [];
    }

    protected static function getSelectOptions()
    {
        return [];
    }

    protected static function getAttributes()
    {
        return [];
    }

    public static function make($name, $options = [])
    {
        $options = static::parseOptions($options);

        return [
            $name => [
                'type' => static::getType(),
                'attributes' => static::getAttributes() ?? [],
                'options' => static::getSelectOptions() ?? [],
                'legend' => $options['legend'] ?? null,
                'label' => $options['label'] ?? null,
                'model_options' => [
                    'label' => $options['label'] ?? 'name',
                    'value' => $options['value'] ?? 'id',
                    'params' => $options['params'] ?? null,
                    'method' => $options['method'] ?? 'all',
                ],
                'model' => $options['model'] ?? null,
                'before' => static::getWrappers($options, 'before'),
                'after' => static::getWrappers($options, 'after'),
                'view' => static::getView() ?? null,
            ]
        ];
    }

    protected static function parseOptions($options)
    {
        return array_merge(static::getOptions(), $options);
    }

    protected static function getWrappers($options, $key)
    {
        $class = 'append';

        if ($key === 'before') {
            $class = 'prepend';
        }

        if (isset($options[$key])) {
            return '<div class="input-group-'.$class.'">
                        <span class="input-group-text">'.$options[$key].'</span>
                    </div>';
        }

        return null;
    }

    protected static function getView()
    {
        return null;
    }
}
