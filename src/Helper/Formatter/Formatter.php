<?php

declare(strict_types=1);

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source declaration.
 */

namespace Ivory\GoogleMap\Helper\Formatter;

use Ivory\GoogleMap\Utility\VariableAwareInterface;

class Formatter
{
    /** @var bool */
    private $debug;

    /** @var int */
    private $indentationStep;

    public function __construct(bool $debug = false, int $indentationStep = 4)
    {
        $this->setDebug($debug);
        $this->setIndentationStep($indentationStep);
    }

    public function isDebug(): bool
    {
        return $this->debug;
    }

    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
    }

    public function getIndentationStep(): int
    {
        return $this->indentationStep;
    }

    public function setIndentationStep(int $indentationStep): void
    {
        $this->indentationStep = $indentationStep;
    }

    /** @param string|false|null $namespace */
    public function renderClass(?string $name = null, $namespace = null): ?string
    {
        if (null === $namespace) {
            $namespace = $this->renderProperty('google', 'maps');
        }

        if (empty($namespace)) {
            return $name;
        }

        return $this->renderProperty($namespace, $name);
    }

    /** @param string|false|null $namespace */
    public function renderConstant(string $class, string $value, $namespace = null): ?string
    {
        return $this->renderClass($this->renderProperty($class, strtoupper($value)), $namespace);
    }

    /** @param string|false|null $namespace */
    public function renderObject(
        string $class,
        array $arguments = [],
               $namespace = null,
        bool $semicolon = false,
        bool $newLine = false
    ): string {
        return $this->renderCall(
            'new '.$this->renderClass($class, $namespace),
            $arguments,
            $semicolon,
            $newLine
        );
    }

    public function renderProperty(string $object, ?string $property = null): string
    {
        if (!empty($property)) {
            $property = '.'.$property;
        }

        return $object.$property;
    }

    /** @param string[] $arguments */
    public function renderObjectCall(
        VariableAwareInterface $object,
        string $method,
        array $arguments = [],
        bool $semicolon = false,
        bool $newLine = false
    ): string {
        return $this->renderCall(
            $this->renderProperty($object->getVariable(), $method),
            $arguments,
            $semicolon,
            $newLine
        );
    }

    /** @param string[] $arguments */
    public function renderCall(
        ?string $method,
        array $arguments = [],
        bool $semicolon = false,
        bool $newLine = false
    ): string {
        return $this->renderCode(
            $method.$this->renderArguments($arguments),
            $semicolon,
            $newLine
        );
    }

    /** @param string[] $arguments */
    public function renderClosure(
        string $code = null,
        array $arguments = [],
        string $name = null,
        bool $semicolon = false,
        bool $newLine = false
    ): string {
        $separator = $this->renderSeparator();

        if (null !== $name) {
            $name = ' '.$name;
        }

        return $this->renderCode($this->renderLines([
            'function'.$name.$separator.$this->renderArguments($arguments).$separator.'{',
            $this->renderIndentation($code),
            '}',
        ], !empty($code), $newLine && !$semicolon), $semicolon, $newLine && $semicolon);
    }

    public function renderObjectAssignment(
        VariableAwareInterface $object,
        string $declaration,
        bool $semicolon = false,
        bool $newLine = false
    ): string {
        return $this->renderAssignment($object->getVariable(), $declaration, $semicolon, $newLine);
    }

    public function renderContainerAssignment(
        VariableAwareInterface $root,
        string $declaration,
        string $propertyPath = null,
        VariableAwareInterface $object = null,
        bool $semicolon = true,
        bool $newLine = true
    ): string {
        return $this->renderAssignment(
            $this->renderContainerVariable($root, $propertyPath, $object),
            $declaration,
            $semicolon,
            $newLine
        );
    }

    public function renderContainerVariable(
        VariableAwareInterface $root,
        string $propertyPath = null,
        VariableAwareInterface $object = null
    ): string {
        $variable = $root->getVariable().'_container';

        if (null !== $propertyPath) {
            $variable = $this->renderProperty($variable, $propertyPath);
        }

        if (null !== $object) {
            $variable = $this->renderProperty($variable, $object->getVariable());
        }

        return $variable;
    }

    public function renderAssignment(
        string $variable,
        string $declaration,
        bool $semicolon = false,
        bool $newLine = false
    ): string {
        $separator = $this->renderSeparator();

        return $this->renderCode($variable.$separator.'='.$separator.$declaration, $semicolon, $newLine);
    }

    public function renderStatement(
        string $statement,
        string $code,
        ?string $condition = null,
        ?string $next = null,
        bool $newLine = true
    ): string {
        $separator = $this->renderSeparator();
        $statement .= $separator;

        if (!empty($condition)) {
            $statement .= $this->renderArguments([$condition]).$separator;
        }

        if (!empty($next)) {
            $next = $separator.$next;
        }

        return $this->renderLines([
            $statement.'{',
            $this->renderIndentation($code),
            '}'.$next,
        ], true, $newLine);
    }

    public function renderCode(string $code, bool $semicolon = true, bool $newLine = true): string
    {
        if ($semicolon) {
            $code .= ';';
        }

        return $this->renderLine($code, $newLine);
    }

    public function renderIndentation(?string $code = null): string
    {
        if ($this->debug && !empty($code)) {
            $indentation = str_repeat(' ', $this->indentationStep);
            $code        = $indentation.str_replace("\n", "\n".$indentation, $code);
        }

        return (string) $code;
    }

    /** @param string[] $codes */
    public function renderLines(array $codes, bool $newLine = true, bool $eolLine = true): string
    {
        $result = '';
        $count  = count($codes);

        for ($index = 0; $index < $count; ++$index) {
            $result .= $this->renderLine($codes[$index], $newLine && $index !== $count - 1);
        }

        return $this->renderLine($result, $eolLine);
    }

    public function renderLine(string $code = null, bool $newLine = true): string
    {
        if ($newLine && !empty($code) && $this->debug) {
            $code .= "\n";
        }

        return (string) $code;
    }

    /** @param string|bool $argument */
    public function renderEscape($argument): string
    {
        return json_encode($argument, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    public function renderSeparator(): string
    {
        return $this->debug ? ' ' : '';
    }

    /** @param string[] $arguments */
    private function renderArguments(array $arguments): string
    {
        return '('.implode(','.$this->renderSeparator(), $arguments).')';
    }
}
