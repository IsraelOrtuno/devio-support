<?php

namespace Devio\Support\Model;

trait HasOptions
{
    public function setOption($key, $value): static
    {
        if (!$this->options) {
            $this->options = [];
        }

        $this->options[$key] = $value;

        return $this;
    }

    public function getOption($key)
    {
        return $this->options[$key] ?? null;
    }

    public function unsetOption($key)
    {
        if (isset($this->options[$key])) {
            unset($this->options[$key]);
        }

        return $this;
    }
}