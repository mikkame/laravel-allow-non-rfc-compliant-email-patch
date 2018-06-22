<?php

namespace Tecpresso\AllowNonRfcComplaintEmailPatch;

use Illuminate\Support\ServiceProvider;

class AllowNonRfcComplaintEmailPatchServiceProvidor extends ServiceProvider
{


      /**
       * Bootstrap any application services.
       *
       * @return void
       */
    public function boot()
    {
        \Swift::init(
              function () {
                  \Swift_DependencyContainer::getInstance()
                    ->register('email.validator')
                    ->asSharedInstanceOf(AllowNonRfcComplaintEmailValidator::class);
              }
          );
    }
}
