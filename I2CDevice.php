<?php

abstract class I2CDevice
{
    private $bus;
    private $chipAddress;

    public function __construct($bus, $chipAddress)
    {
        $this->bus = $bus;
        $this->chipAddress = $chipAddress;
    }

    protected function i2cGet($dataAddress)
    {
        $command = 'i2cget -y ' . (
            escapeshellarg($this->bus) . ' ' .
            escapeshellarg($this->chipAddress) . ' ' .
            escapeshellarg($dataAddress) . ' '
        ) . 'b';

        return base_convert($this->execute($command), 16, 10);
    }

    protected function i2cGetWord($dataAddress)
    {
        $command = 'i2cget -y ' . (
            escapeshellarg($this->bus) . ' ' .
            escapeshellarg($this->chipAddress) . ' ' .
            escapeshellarg($dataAddress) . ' '
        ) . 'w';

        return base_convert($this->execute($command), 16, 10);
    }

    protected function i2cSet($dataAddress, $value)
    {
        $command = 'i2cset -y ' . (
            escapeshellarg($this->bus) . ' ' .
            escapeshellarg($this->chipAddress) . ' ' .
            escapeshellarg($dataAddress) . ' ' .
            escapeshellarg($value) . ' '
        ) . 'b';

        $this->execute($command);
    }

    protected function i2cSetWord($dataAddress, $value)
    {
        $command = 'i2cset -y ' . (
            escapeshellarg($this->bus) . ' ' .
            escapeshellarg($this->chipAddress) . ' ' .
            escapeshellarg($dataAddress) . ' ' .
            escapeshellarg($value) . ' '
        ) . 'w';

        $this->execute($command);
    }

    private function execute($command)
    {
        $result = shell_exec($command . ' 2>&1');

        if (strncmp($result, 'Error:', 6) === 0) {
            throw new RuntimeException($result);
        }

        return $result;
    }
}

