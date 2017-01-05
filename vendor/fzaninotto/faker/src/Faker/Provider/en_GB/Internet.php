<?php

namespace Faker\Provider\en_GB;

class Internet extends \Faker\Provider\Internet
{
    protected static $freeEmailDomain = array('gmail.com', 'yahoo.com', 'hotmail.com', 'gmail.co.ua', 'yahoo.co.ua', 'hotmail.co.ua');
    protected static $tld = array('com', 'com', 'com', 'com', 'com', 'com', 'biz', 'info', 'net', 'org', 'co.ua');
}
