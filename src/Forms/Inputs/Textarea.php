<?php

declare(strict_types=1);

namespace BladeUIKit\Forms\Inputs;

use BladeUIKit\Component;
use Illuminate\Contracts\View\View;

class Textarea extends Component
{
    /** @var string */
    public $name;

    /** @var string */
    public $id;

    /** @var int */
    public $rows;

    public function __construct(string $name, string $id = null, $rows = 3)
    {
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->rows = $rows;
    }

    public function render(): View
    {
        return view('blade-ui-kit::components.forms.inputs.textarea');
    }

    /**
     * @internal This method should not be overridden outside the package.
     */
    public static function componentAlias(): string
    {
        return 'textarea';
    }
}
