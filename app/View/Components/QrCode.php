<?php

namespace App\View\Components;

use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class QrCode extends Component
{
    public string $svg;

    public function __construct(public string $data, public int $size = 160)
    {
        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle($this->size, 0, null, null, Fill::uniformColor(new Rgb(255, 255, 255), new Rgb(0, 0, 0))),
                new SvgImageBackEnd
            )
        );

        $svg = $writer->writeString($this->data);
        $this->svg = trim(substr($svg, strpos($svg, "\n") + 1));
    }

    public function render(): View
    {
        return view('components.qr-code');
    }
}
