<?php
/*
 * Copyright (c) 2022. Hafees Olasunkanmi OLATUNJI.
 * Email: aphzol@gmail.com
 * The entire source code of this project is an intellectual property of Hafees Olasunkanmi OLATUNJI
 * and his respective contributors as indicated in header of their respective files.
 * All libraries used in this project are intellectual properties of their respective authors
 * and their licence included where deemed fit.
 * All right reserved. No party has any right whatsoever to duplicate the content therein digitally
 * or otherwise without express written permission from the company.
 */


namespace aphzol\apis\driver;

use \Illuminate\Support\ServiceProvider;

class BraincertServiceProvider extends ServiceProvider {
    public function register()
    {
        $this->app->singleton('braincert', Braincert::class);
    }
}
