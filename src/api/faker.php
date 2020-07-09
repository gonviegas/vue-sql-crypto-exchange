<?php
require_once ('../vendor/autoload.php');
require_once ('db.php');


$faker = Faker\Factory::create();

$currency = array(
    1 => 'btc',
    2 => 'eth',
    3 => 'xrp',
    4 => 'xlm',
    5 => 'dgb'
);

$currency_row = 1;

for ($i=0; $i < 20; $i++) {
    $sql = "INSERT INTO customer(email, first_name, last_name, verified, status, password, token, timestamp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $timestamp = $faker->date('U');

    $stmt = conn()->prepare($sql);
    $stmt->execute([
        $faker->email,
        $faker->firstName,
        $faker->lastName,
        $faker->numberBetween($min = 0, $max = 1),
        $faker->randomElement(['active', 'inactive', 'suspended', 'blocked']),
        password_hash($faker->password, PASSWORD_BCRYPT),
        sha1(bin2hex($timestamp)),
        $timestamp
    ]);
}

for ($i=0; $i < 10; $i++) {
    $sql = "INSERT INTO news(title, body, date) VALUES (?, ?, ?)";

    $stmt = conn()->prepare($sql);
    $stmt->execute([
        $faker->words($nb = 8, $asText = true), 
        $faker->text($maxNbChars = 100), 
        $faker->date
    ]);
}

for ($i=0; $i < 10; $i++) {
    $sql = "INSERT INTO  staff(first_name, last_name, username, email, image, level, active, password, token) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $token_image = sha1(bin2hex($faker->date('U')));

    $stmt = conn()->prepare($sql);
    $stmt->execute([
        $faker->firstName,
        $faker->lastName, 
        $faker->userName,
        $faker->email,
        $token_image,
        $faker->numberBetween($min = 0, $max = 1),
        $faker->numberBetween($min = 0, $max = 1),
        password_hash($faker->password, PASSWORD_BCRYPT),
        $token_image
    ]);
}

for ($i=0; $i < 5; $i++) {
    $sql = "INSERT INTO store_wallet(currency, balance, fee, usd, eur) VALUES ( ?, ?, ?, ?, ?)";

    $stmt = conn()->prepare($sql);
    $stmt->execute([
        $currency[$currency_row++],
        $faker->randomFloat($nbMaxDecimals = 8, $min = 1000000, $max = 10000000000), 
        $faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 5),
        0,
        0
    ]);
}

for ($i=0; $i < 40; $i++) {
    $sql = "INSERT INTO transfer(date, from_address, from_currency, from_volume, to_address, to_currency, to_volume) VALUES ( ?, ?, ?, ?, ?, ?, ?)";

    $stmt = conn()->prepare($sql);
    $stmt->execute([
        $faker->date,
        password_hash($faker->numberBetween($min = 1, $max = 20), PASSWORD_BCRYPT),
        $currency[$faker->numberBetween($min = 1, $max = 5)],
        $faker->randomFloat($nbMaxDecimals = 8, $min = 1, $max = 1000000),
        password_hash($faker->numberBetween($min = 1, $max = 20), PASSWORD_BCRYPT),
        $currency[$faker->numberBetween($min = 1, $max = 5)],
        $faker->randomFloat($nbMaxDecimals = 8, $min = 1, $max = 1000000)
    ]);
}

for ($i=0; $i < 40; $i++) {
    $sql = "INSERT INTO wallet(customer_id, currency, balance, usd, eur, value) VALUES ( ?, ?, ?, ?, ?, ?)";

    $stmt = conn()->prepare($sql);
    $stmt->execute([
        $faker->numberBetween($min = 1, $max = 20),
        $currency[$faker->numberBetween($min = 1, $max = 5)],
        $faker->randomFloat($nbMaxDecimals = 8, $min = 1, $max = 1000000),
        0,
        0,
        0
    ]);
}
