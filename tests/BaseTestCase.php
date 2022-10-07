<?php
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class BaseTestCase extends KernelTestCase
{
    protected static function getPayload(string $fileName): array {
        $filePath = sprintf('tests/payloads/%s.json', $fileName);

        return static::getDecodedJsonFile($filePath);
    }

    protected static function getProjectDir(): string
    {
        return static::getContainer()->getParameter('kernel.project_dir');
    }

    protected static function getDecodedJsonFile(string $filePath): array
    {
        $file = sprintf('%s/%s', static::getProjectDir(), $filePath);

        assert(file_exists($file));

        $content = file_get_contents($file);

        assert(is_string($content));

        /* @phpstan-ignore-next-line */
        return json_decode($content, true);
    }
}