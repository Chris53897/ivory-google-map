<?php

declare(strict_types=1);

namespace Ivory\GoogleMap\Service\Serializer;

use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class GoogleDateTimeNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public const FORMAT_KEY = 'datetime_format';
    public const TIMEZONE_KEY = 'datetime_timezone';

    private array $defaultContext = [
        self::FORMAT_KEY => 'U',
        self::TIMEZONE_KEY => null,
    ];

    private const SUPPORTED_TYPES = [
        \DateTimeInterface::class => true,
        \DateTimeImmutable::class => true,
        \DateTime::class => true,
    ];

    public function __construct(array $defaultContext = [])
    {
        $this->setDefaultContext($defaultContext);
    }

    public function setDefaultContext(array $defaultContext): void
    {
        $this->defaultContext = array_merge($this->defaultContext, $defaultContext);
    }

    /**
     * {@inheritdoc}
     */
    public function normalize(mixed $object, ?string $format = null, array $context = []): float|int|bool|\ArrayObject|array|string|null
    {
        if (!$object instanceof \DateTimeInterface) {
            throw new InvalidArgumentException('The object must implement the "\DateTimeInterface".');
        }

        $dateTimeFormat = $context[self::FORMAT_KEY] ?? $this->defaultContext[self::FORMAT_KEY];
        $timezone = $this->getTimezone($context);

        if (null !== $timezone) {
            $object = clone $object;
            $object = $object->setTimezone($timezone);
        }

        return $object->format($dateTimeFormat);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof \DateTimeInterface;
    }

    /**
     * {@inheritdoc}
     *
     * @return \DateTimeInterface
     *
     * @throws NotNormalizableValueException
     */
    public function denormalize($data, string $type, ?string $format = null, array $context = []): mixed
    {
        $dateTimeFormat = $context[self::FORMAT_KEY] ?? null;
        $timezone = $this->getTimezone($context);

        if (null === $data) {
            throw NotNormalizableValueException::createForUnexpectedDataType('The data is either not an string, an empty string, or null; you should pass a string that can be parsed with the passed format or a valid DateTime string.', $data, [Type::BUILTIN_TYPE_STRING], $context['deserialization_path'] ?? null, true);
        }

        try {
            if (null !== $dateTimeFormat) {
                $object = \DateTime::class === $type ? \DateTime::createFromFormat($dateTimeFormat, $data, $timezone) : \DateTimeImmutable::createFromFormat($dateTimeFormat, $data, $timezone);

                if (false !== $object) {
                    return $object;
                }

                $dateTimeErrors = \DateTime::class === $type ? \DateTime::getLastErrors() : \DateTimeImmutable::getLastErrors();

                throw NotNormalizableValueException::createForUnexpectedDataType(sprintf('Parsing datetime string "%s" using format "%s" resulted in %d errors: ', $data, $dateTimeFormat, $dateTimeErrors['error_count'])."\n".implode("\n", $this->formatDateTimeErrors($dateTimeErrors['errors'])), $data, [Type::BUILTIN_TYPE_STRING], $context['deserialization_path'] ?? null, true);
            }

            $defaultDateTimeFormat = $this->defaultContext[self::FORMAT_KEY] ?? null;

            if (null !== $defaultDateTimeFormat) {
                $object = \DateTime::class === $type ? \DateTime::createFromFormat($defaultDateTimeFormat, (string) $data, $timezone) : \DateTimeImmutable::createFromFormat($defaultDateTimeFormat, $data, $timezone);

                if (false !== $object) {
                    return $object;
                }
            }

            return \DateTime::class === $type ? new \DateTime($data, $timezone) : new \DateTimeImmutable($data, $timezone);
        } catch (NotNormalizableValueException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw NotNormalizableValueException::createForUnexpectedDataType($e->getMessage(), $data, [Type::BUILTIN_TYPE_STRING], $context['deserialization_path'] ?? null, false, $e->getCode(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return isset(self::SUPPORTED_TYPES[$type]);
    }

    /**
     * Formats datetime errors.
     *
     * @return string[]
     */
    private function formatDateTimeErrors(array $errors): array
    {
        $formattedErrors = [];

        foreach ($errors as $pos => $message) {
            $formattedErrors[] = sprintf('at position %d: %s', $pos, $message);
        }

        return $formattedErrors;
    }

    /**
     * @throws \Exception
     */
    private function getTimezone(array $context): ?\DateTimeZone
    {
        $dateTimeZone = $context[self::TIMEZONE_KEY] ?? $this->defaultContext[self::TIMEZONE_KEY];

        if (null === $dateTimeZone) {
            return null;
        }

        return $dateTimeZone instanceof \DateTimeZone ? $dateTimeZone : new \DateTimeZone($dateTimeZone);
    }

    /**
     * {@inheritdoc}
     */
    public function getSupportedTypes(?string $format): array
    {
        return self::SUPPORTED_TYPES;
    }
}