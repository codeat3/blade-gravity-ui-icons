<?php

declare(strict_types=1);

namespace Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Config;
use BladeUI\Icons\BladeIconsServiceProvider;
use Codeat3\BladeGravityUiIcons\BladeGravityUiIconsServiceProvider;

class CompilesIconsTest extends TestCase
{
    /** @test */
    public function it_compiles_a_single_anonymous_component()
    {
        $result = svg('gravityui-ban')->toHtml();

        // Note: the empty class here seems to be a Blade components bug.
        $expected = <<<'SVG'
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M11.323 12.383a5.5 5.5 0 0 1-7.706-7.706l7.706 7.706Zm1.06-1.06L4.677 3.617a5.5 5.5 0 0 1 7.706 7.706ZM15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" clip-rule="evenodd"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_classes_to_icons()
    {
        $result = svg('gravityui-ban', 'w-6 h-6 text-gray-500')->toHtml();

        $expected = <<<'SVG'
            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M11.323 12.383a5.5 5.5 0 0 1-7.706-7.706l7.706 7.706Zm1.06-1.06L4.677 3.617a5.5 5.5 0 0 1 7.706 7.706ZM15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" clip-rule="evenodd"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_styles_to_icons()
    {
        $result = svg('gravityui-ban', ['style' => 'color: #555'])->toHtml();

        $expected = <<<'SVG'
            <svg style="color: #555" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M11.323 12.383a5.5 5.5 0 0 1-7.706-7.706l7.706 7.706Zm1.06-1.06L4.677 3.617a5.5 5.5 0 0 1 7.706 7.706ZM15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" clip-rule="evenodd"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_default_class_from_config()
    {
        Config::set('blade-gravity-ui-icons.class', 'awesome');

        $result = svg('gravityui-ban')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M11.323 12.383a5.5 5.5 0 0 1-7.706-7.706l7.706 7.706Zm1.06-1.06L4.677 3.617a5.5 5.5 0 0 1 7.706 7.706ZM15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" clip-rule="evenodd"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_merge_default_class_from_config()
    {
        Config::set('blade-gravity-ui-icons.class', 'awesome');

        $result = svg('gravityui-ban', 'w-6 h-6')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M11.323 12.383a5.5 5.5 0 0 1-7.706-7.706l7.706 7.706Zm1.06-1.06L4.677 3.617a5.5 5.5 0 0 1 7.706 7.706ZM15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" clip-rule="evenodd"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            BladeGravityUiIconsServiceProvider::class,
        ];
    }
}
