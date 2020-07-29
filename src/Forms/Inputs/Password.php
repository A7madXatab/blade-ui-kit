<?php

declare(strict_types=1);

namespace BladeUIKit\Forms\Inputs;

use Illuminate\Contracts\View\View;

class Password extends Input
{
    public function __construct(string $name = 'password', string $id = null)
    {
        parent::__construct($name, $id, 'password');
    }

    public function render(): View
    {
        return view('blade-ui-kit::components.forms.inputs.password');
    }

    final public static function componentAlias(): string
    {
        return 'password';
    }
}
