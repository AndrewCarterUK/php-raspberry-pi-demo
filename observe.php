<?php

require_once 'GPS.php';
require_once 'I2CDevice.php';
require_once 'MPU6050.php';

$gps = new GPS('/dev/ttyUSB0');

$accelerometer = new MPU6050();
$accelerometer->wake();

while (1) {
    $data = [
        'gps' => $gps->getFixData(),
        'gyro' => $accelerometer->getGyroData(),
        'acceleration' => $accelerometer->getAccelerationData(),
    ];

    system('clear');

    print_r($data);

    sleep(5);
}

