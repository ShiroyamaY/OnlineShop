<?php

if(!function_exists("flash"))
{
    function flash()
    {
        return app(\App\Support\Flash\Flash::class);
    }
}
