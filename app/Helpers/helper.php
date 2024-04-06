<?php

const READ = "r";
const WRITE = "w";
const APPEND = "a";
const MALE = "male";
const FEMALE = "female";
const OTHER = "other";
const EMAIL = "email";
const PHONE = "phone";


function makeAssoc($data, $columns)
{
    $result = [];
    foreach ($data as $key => $item) {
        $result[$columns[$key]] = $item;
    }
    return $result;
}