<?php

declare(strict_types=1);

namespace BladeUIKit\Buttons;

use BladeUIKit\Component;
use Illuminate\Contracts\View\View;

class FormButton extends Component
{
    /** @var string */
    public $action;

    /** @var string */
    public $method;

    public function __construct(string $action, string $method = 'POST')
    {
        $this->action = $action;
        $this->method = strtoupper($method);
    }

    public function render(): View
    {
        return view('blade-ui-kit::components.buttons.form-button');
    }

    /**
     * @internal This method should not be overridden outside the package.
     */
    public static function componentAlias(): string
    {
        return 'form-button';
    }
}
