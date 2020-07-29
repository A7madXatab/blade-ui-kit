<?php

declare(strict_types=1);

namespace BladeUIKit\Forms\Inputs;

use BladeUIKit\Component;
use Illuminate\Contracts\View\View;

class Input extends Component
{
    /** @var string */
    public $name;

    /** @var string */
    public $id;

    /** @var string */
    public $type;

    /** @var string */
    public $value;

    public function __construct(string $name, string $id = null, string $type = 'text', string $value = '')
    {
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->type = $type;
        $this->value = old($name, $value);
    }

    public function render(): View
    {
        return view('blade-ui-kit::components.forms.inputs.input');
    }

    /**
     * @internal This method should not be overridden outside the package.
     */
    public static function componentAlias(): string
    {
        return 'input';
    }
}
