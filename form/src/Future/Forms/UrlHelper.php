<?php

namespace Future\Form\Future\Forms;

class UrlHelper
{
    protected static ?string $url = null;

    public static function setUrl(string $url): void
    {
        self::$url = $url;
    }

    public static function getUrl(): ?string
    {
        return self::$url;
    }
}
