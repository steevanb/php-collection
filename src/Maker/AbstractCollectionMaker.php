<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Maker;

use Steevanb\PhpCollection\ObjectCollection\AbstractObjectCollection;

abstract class AbstractCollectionMaker
{
    abstract protected function getCollectionSuffix(): string;

    abstract protected function getTemplateName(): string;

    private string $templatePath;

    public function __construct()
    {
        $this->templatePath = dirname(__DIR__, 2) . '/templates';
    }

    /** @param class-string $valueFqcn */
    public function make(string $valueFqcn, string $collectionPath, string $collectionNamespace): static
    {
        $this->createDirectory($collectionPath);

        if (str_starts_with($valueFqcn, '\\') && substr_count($valueFqcn, '\\') === 1) {
            $valueUse = null;
            $valueClassName = $valueFqcn;
            $collectionClassName = substr($valueFqcn, 1) . $this->getCollectionSuffix();
        } else {
            $valueUse = 'use ' . $valueFqcn . ";\n";
            $valueClassName = basename(str_replace('\\', '/', $valueFqcn));
            $collectionClassName = $valueClassName . $this->getCollectionSuffix();
        }

        return $this->writeCollection(
            $collectionPath,
            $collectionClassName,
            $this->getTemplateName(),
            [
                '$$ABSTRACT_OBJECT_COLLECTION_USE$$' =>
                    $collectionNamespace === 'Steevanb\\PhpCollection\\ObjectCollection'
                        ? null
                        : "\n" . 'use ' . AbstractObjectCollection::class . ';',
                '$$COLLECTION_NAMESPACE$$' => $collectionNamespace,
                '$$COLLECTION_CLASS_NAME$$' => $collectionClassName,
                '$$VALUE_USE$$' => $valueUse,
                '$$VALUE_CLASS_NAME$$' => $valueClassName
            ]
        );
    }

    protected function createDirectory(string $directory): static
    {
        if (is_dir($directory) === false) {
            mkdir($directory, 0644, true);
        }

        return $this;
    }

    /** @param array<string, mixed> $parameters */
    protected function render(string $templatePathname, array $parameters): string
    {
        $content = file_get_contents($templatePathname);
        if (is_string($content) === false) {
            throw new \Exception('Template ' . $templatePathname . ' not found.');
        }

        $content = str_replace(array_keys($parameters), $parameters, $content);

        return $this->removeMultipleEmptyLines($content);
    }

    /** @param array<string, mixed> $templateParameters */
    protected function writeCollection(
        string $collectionPath,
        string $collectionClassName,
        string $templateName,
        array $templateParameters = []
    ): static {
        $collectionPathname = $collectionPath . '/' . $collectionClassName . '.php';

        $writed = file_put_contents(
            $collectionPathname,
            $this->render(
                $this->templatePath . '/collection/' . $templateName,
                $templateParameters
            )
        );

        if (is_int($writed) === false) {
            throw new \Exception('Error while writing file ' . $collectionPathname . '.');
        }

        return $this;
    }

    protected function &removeMultipleEmptyLines(string &$content): string
    {
        $previousLine = null;
        $return = null;
        $lines = explode("\n", $content);
        foreach ($lines as $lineIndex => $line) {
            if ($line === '' && $previousLine === '') {
                continue;
            }

            $return .= $line;
            if ($lineIndex < count($lines) - 1) {
                $return .= "\n";
            }
            $previousLine = $line;
        }

        if (is_string($return) === false) {
            throw new \Exception('No content has been generated.');
        }

        return $return;
    }
}
