<?php

class MPU6050 extends I2CDevice
{
    const CHIP_ADDRESS = 0x68;
    const WAKE_UP_ADDRESS = 0x6B;
    const GYRO_X_ADDRESS = 0x43;
    const GYRO_Y_ADDRESS = 0x45;
    const GYRO_Z_ADDRESS = 0x47;
    const ACCL_X_ADDRESS = 0x3B;
    const ACCL_Y_ADDRESS = 0x3D;
    const ACCL_Z_ADDRESS = 0x3F;

    public function __construct($bus = 1, $chipAddress = self::CHIP_ADDRESS)
    {
        parent::__construct($bus, $chipAddress);
    }

    public function wake()
    {
        $this->i2cSet(self::WAKE_UP_ADDRESS, 0);
    }

    public function getGyroData()
    {
        return [
            'x' => $this->i2cGetWord(self::GYRO_X_ADDRESS) / 131,
            'y' => $this->i2cGetWord(self::GYRO_Y_ADDRESS) / 131,
            'z' => $this->i2cGetWord(self::GYRO_Z_ADDRESS) / 131,
        ];
    }

    public function getAccelerationData()
    {
        return [
            'x' => $this->i2cGetWord(self::ACCL_X_ADDRESS) / 16384,
            'y' => $this->i2cGetWord(self::ACCL_Y_ADDRESS) / 16384,
            'z' => $this->i2cGetWord(self::ACCL_Z_ADDRESS) / 16384,
        ];
    }
}

