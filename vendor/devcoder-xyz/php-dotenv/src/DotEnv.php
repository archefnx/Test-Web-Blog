<?php

namespace DevCoder;

<<<<<<< HEAD
class DotEnv
{
    /**
     * Convert true and false to booleans, instead of:
     *
     * VARIABLE=false -> ['VARIABLE' => 'false']
     *
     * it will be
     *
     * VARIABLE=false -> ['VARIABLE' => false]
     *
     * default = true
     */
    const PROCESS_BOOLEANS = 'PROCESS_BOOLEANS';

    /**
=======
use DevCoder\Processor\AbstractProcessor;
use DevCoder\Processor\BooleanProcessor;
use DevCoder\Processor\QuotedProcessor;

class DotEnv
{
    /**
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
     * The directory where the .env file can be located.
     *
     * @var string
     */
    protected $path;

    /**
     * Configure the options on which the parsed will act
     *
<<<<<<< HEAD
     * @var array
     */
    protected $options = [];

    public function __construct(string $path, array $options = [])
=======
     * @var string[]
     */
    protected $processors = [];

    public function __construct(string $path, array $processors = null)
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
        }

        $this->path = $path;

<<<<<<< HEAD
        $this->processOptions($options);
    }

    private function processOptions(array $options) : void
    {
        $this->options = array_merge([
            static::PROCESS_BOOLEANS => true
        ], $options);
=======
        $this->setProcessors($processors);
    }

    private function setProcessors(array $processors = null) : DotEnv
    {
        /**
         * Fill with default processors
         */
        if ($processors === null) {
            $this->processors = [
                BooleanProcessor::class,
                QuotedProcessor::class
            ];

            return $this;
        }

        foreach ($processors as $processor) {
            if (is_subclass_of($processor, AbstractProcessor::class)) {
                $this->processors[] = $processor;
            }
        }

        return $this;
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
    }

    /**
     * Processes the $path of the instances and parses the values into $_SERVER and $_ENV, also returns all the data that has been read.
     * Skips empty and commented lines.
     */
    public function load() : void
    {
        if (!is_readable($this->path)) {
            throw new \RuntimeException(sprintf('%s file is not readable', $this->path));
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = $this->processValue($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }

<<<<<<< HEAD
    private function processValue(string $value) {
        $trimmedValue = trim($value);

        if (!empty($this->options[static::PROCESS_BOOLEANS])) {
            $loweredValue = strtolower($trimmedValue);

            $isBoolean = in_array($loweredValue, ['true', 'false'], true);

            if ($isBoolean) {
                return $loweredValue === 'true';
            }
        }

=======
    /**
     * Process the value with the configured processors
     *
     * @param string $value The value to process
     * @return string|bool
     */
    private function processValue(string $value)
    {
        /**
         * First trim spaces and quotes if configured
         */
        $trimmedValue = trim($value);

        foreach ($this->processors as $processor) {
            /** @var AbstractProcessor $processorInstance */
            $processorInstance = new $processor($trimmedValue);

            if ($processorInstance->canBeProcessed()) {
                return $processorInstance->execute();
            }
        }

        /**
         * Does not match any processor options, return as is
         */
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
        return $trimmedValue;
    }
}
