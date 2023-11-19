<h1 align="center">Fast Replace for Laravel</h1>


## Introduction

Fast Replace for Laravel is a powerful and versatile package 
designed to streamline text manipulation tasks within the 
Laravel framework. Tailored for developers seeking 
efficiency and simplicity, this package provides a range 
of tools to effortlessly transform and manipulate text data 
in their Laravel applications.

## Performance

The performance comparison was made with PHP 8.2.1 and MariaDB 10.6.12
text size 62069 characters and and there were duplicate keys in the text 
measurements were taken 3 times and 200 iterations.
The results will be Fast Replace / Fast Replace cache / 
Str::replace / Str::replace cache

So......

### No data received from classes

Fast Replace: 15.844359 sec / 15.579132 sec / 16.032425 sec

Fast Replace and cache: 0.294150 sec / 0.259240 sec / 0.236989 sec

Str::replace: 17.547049 sec / 17.112469 sec / 16.710757 sec

Str::replace cache: 3.934095 sec / 4.042395 sec / 4.094361 sec

### We provide ready-made data

    Fast Replace: 0.004951 sec / 0.005213 sec / 0.005084 sec

    Str::replace: 0.008216 sec / 0.004294 sec / 0.006443 sec

Text size 498183 characters

    Fast Replace: 0.038984 sec / 0.047993 sec / 0.038661 sec

    Str::replace: 0.049044 sec / 0.050786 sec / 0.057625 sec

    Fast Replace Memory usage: 1009496 bytes Peak memory usage: 1513256 bytes

    Str::replace Memory usage: 1004624 bytes Peak memory usage: 1888072 bytes

Text size 1565024 characters

    Fast Replace: 0.237349 sec / 0.255545 sec / 0.253437 sec

    Str::replace: 0.698960 sec / 0.260386 sec / 0.160027 sec

    Fast Replace Memory usage: 3151704 bytes Peak memory usage: 5387896 bytes

    Str::replace Memory usage: 3155024 bytes Peak memory usage: 6201160 bytes

### Still interested? then let's continue...


## Official Documentation

Step 1:     

            composer require bytenetizen/fast-replace

Step 2: 

            php artisan migrate

            php artisan replace:seed

### Config

        life_cache default 10080 minute

        use_cache default true

        is_debug default false

### add .env *optional

        REPLACE_CACHE_LIFE=1
        REPLACE_USE_CACHE=false
        REPLACE_IS_DEBUG=false

### use Fast Replace

        use Bytenetizen\FastReplace\Facades\Replace;

notation: Use options can be combined!

option: 1 pass parameters immediately

        $arr = [
            'arrPlaceholder'=>['TEST'=>'Yap! Good test!','MY_NAME'=>'Promitey'],
        ];

        $startText = '{{TEST}} Lorem ipsum dolor sit amet, my name {{MY_NAME}}, consectetur adipiscing elit';

        $finishText = Replace::transform($startText,$arr);

        echo $finishText;

        "Yap! Good test! Lorem ipsum dolor sit amet, my name Promitey, consectetur adipiscing elit";

option: 2 use classes

        $startText = '{{TEST}}, {{NOW_TIME}} Lorem ipsum dolor sit amet, my name {{MY_NAME}}, consectetur adipiscing elit';

        $finishText = Replace::transform($startText);

        echo $finishText;

        "Hello world! PieceTest!, Wednesday 15th of November 2023 05:51:27 PM Lorem ipsum dolor sit amet, my name , consectetur adipiscing elit"


create new class 

        php artisan make:placeholder PieceMyNew

app/Services/PieceMutators/PieceMyNew.php

insert DB new placeholder

        INSERT INTO `placeholders`(`piece`, `doer`, `admin_id`, `comments`) VALUES ('MY_NEW','App\Services\PieceMutators\PieceMyNew','1','my first Piece')

next: 

        $startText = '{{MY_NEW}}!!! {{TEST}}, {{NOW_TIME}} Lorem ipsum dolor sit amet, my name {{MY_NAME}}, consectetur adipiscing elit';

        $finishText = Replace::transform($startText);

        echo $finishText;

        "PieceMyNew!! Hello world! PieceTest!, Wednesday 15th of November 2023 06:52:34 PM Lorem ipsum dolor sit amet, my name , consectetur adipiscing elit"

class

        use Bytenetizen\FastReplace\PieceMutators\Piece;

        class PieceMyNew extends Piece
        {
            public function getValue(): string
            {

                $this->placeholder; //The object itself is accessible Bytenetizen\ValueSwapper\Models\Placeholder
                $this->settings; //an array ($arr) is available with settings passed to $finishText = SwapperText::transform($startText,$arr);

                //for example, you can pass the user id and then do manipulations with the user object

                    $userId = $this->settings['user_id']??null;
                    $user = User::find($userId);

                return $user->name??'';
            }
        }


use classes


        $startText = '{{MY_NEW}}!!! {{TEST}}, {{NOW_TIME}} Lorem ipsum dolor sit amet, my name {{MY_NAME}}, consectetur adipiscing elit';

        $finishText = Replace::transform($startText);

        echo $finishText;



debug:

        $arr = [
            'arrPlaceholder'=>['TEST'=>'Yap! Good test!','MY_NOT_NAME'=>'Promitey'],
        ];

        $startText = '{{TEST_NOT_DATA}} Lorem ipsum dolor sit amet, my name {{MY_NAME}}, consectetur adipiscing elit';

        $finishText = Replace::transform($startText,$arr);

        echo $finishText;

        "!_EMPTY_{{TEST_NOT_DATA}}_! Lorem ipsum dolor sit amet, my name !_EMPTY_{{MY_NAME}}_!, consectetur adipiscing elit"


clean Placeholder

if placeholders are not needed, you can remove them

        $startText = '{{TEST_NOT_DATA}} Lorem ipsum dolor sit amet, my name {{MY_NAME}}, consectetur adipiscing elit';

        $arrDel = ['TEST_NOT_DATA','MY_NAME'];

        $cleanText = Replace::cleanPlaceholder($startText,$arrDel);

        echo $cleanText;

        "Lorem ipsum dolor sit amet, my name , consectetur adipiscing elit'

## Contributing

Thank you for considering contributing to Fast Replace!

## License

Laravel Tinker is open-sourced software licensed under the [MIT license](LICENSE.md).
