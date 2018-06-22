<?php namespace Tecpresso\AllowNonRfcComplaintEmailPatch;

use Mail;

class AllowNonRfcComplaintEmailPatchTest extends \Orchestra\Testbench\TestCase
{
    protected $middleware;

    /**
     * Load the package
     * @return array the packages
     */
    protected function getPackageProviders($app)
    {
        return [
            AllowNonRfcComplaintEmailPatchServiceProvidor::class
        ];
    }

    /** @test **/
    public function test_excepted_error()
    {
        Mail::raw('this is test mail', function ($message) {
            $message->to('test@example.com');
            $message->from('test@example.com');
        });
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function test_allowd_email()
    {
        Mail::raw('this is test mail', function ($message) {
            $message->to('.not-rfc@example.com');
            $message->from('test@example.com');
        });
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function test_allowd_emai2()
    {
        Mail::raw('this is test mail', function ($message) {
            $message->to('not-rfc.@example.com');
            $message->from('test@example.com');
        });
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function test_allowd_emai3()
    {
        Mail::raw('this is test mail', function ($message) {
            $message->to('not..rfc@example.com');
            $message->from('test@example.com');
        });
        $this->assertTrue(true);
    }



    /**
     * @expectedException Swift_RfcComplianceException
     */
    public function test_excepted_error1()
    {
        Mail::raw('this is test mail', function ($message) {
            $message->to('@');
            $message->from('test@example.com');
        });
    }


    /**
     * @expectedException Swift_RfcComplianceException
     */
    public function test_excepted_error2()
    {
        Mail::raw('this is test mail', function ($message) {
            $message->to('');
            $message->from('test@example.com');
        });
    }

    /**
     * @expectedException Swift_RfcComplianceException
     */
    public function test_excepted_error3()
    {
        Mail::raw('this is test mail', function ($message) {
            $message->to(null);
            $message->from('test@example.com');
        });
    }
}
