<?php

view()->composer([
   'user::dashboard.users.show' ,
   'company::dashboard.companies.show'
], \Modules\Package\ViewComposers\Dashboard\PackageComposer::class);

