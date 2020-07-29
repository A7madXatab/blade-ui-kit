<?php

declare(strict_types=1);

namespace BladeUIKit\DateTime;

use BladeUIKit\Component;
use Carbon\CarbonInterface;
use Illuminate\Contracts\View\View;

class DateTime extends Component
{
    /** @var CarbonInterface */
    public $date;

    /** @var string */
    public $format;

    /** @var bool */
    public $human = false;

    public function __construct(CarbonInterface $date, string $format = 'Y-m-d H:i:s', bool $human = false)
    {
        $this->date = $date;
        $this->format = $format;
        $this->human = $human;
    }

    public function render(): View
    {
        return view('blade-ui-kit::components.date-time.date-time');
    }

    final public static function internalAlias(): string
    {
        return 'date-time';
    }
}
