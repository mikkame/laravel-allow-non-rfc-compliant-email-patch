<?php namespace Tecpresso\AllowNonRfcComplaintEmailPatch;

use Mail;
use Egulias\EmailValidator\Validation\RFCValidation;

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
     */
    public function test_excepted_error1()
    {
        $this->expectException(\Swift_RfcComplianceException::class);

        Mail::raw('this is test mail', function ($message) {
            $message->to('@');
            $message->from('test@example.com');
        });
    }

    /**
     */
    public function test_excepted_error2()
    {
        $this->expectException(\Swift_RfcComplianceException::class);

        Mail::raw('this is test mail', function ($message) {
            $message->to('');
            $message->from('test@example.com');
        });
    }

    /**
     */
    public function test_excepted_error3()
    {
        $this->expectException(\Swift_RfcComplianceException::class);

        Mail::raw('this is test mail', function ($message) {
            $message->to(null);
            $message->from('test@example.com');
        });
    }

    public function emailDataProvider()
    {
        return [
            ['test@example.com', true],
            ['a@b', true],
            ['.@.', true],
            ['@', false],
            ['chars', false],
            ['chars@', false],
            ['@chars', false],
        ];
    }

    /**
     * @dataProvider emailDataProvider
     */
    public function testEmailValidation($email, $expected)
    {
        $emailValidator = new AllowNonRfcComplaintEmailValidator();
        $this->assertSame($expected, $emailValidator->isValid($email, new RFCValidation()));
    }

    /**
     * Validatorの適用を確認
     */
    public function testLookupSharedInstance()
    {
        $container = \Swift_DependencyContainer::getInstance();
        $this->assertInstanceOf(
            AllowNonRfcComplaintEmailValidator::class,
            $container->lookup('email.validator')
        );
    }
}
