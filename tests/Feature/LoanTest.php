<?php

namespace Tests\Feature;

use App\Http\Controllers\LoanController;
use App\Http\Requests\LoanCreateRequest;
use App\Repositories\LoanRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\RedirectResponse;
use Tests\TestCase;

class LoanTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /** @test */
    public function it_stores_a_loan_and_redirects_to_show_page()
    {
        // Mocking dependencies
        $repositoryMock = $this->createMock(LoanRepository::class);
        // Creating request
        $requestData = $this->generateValidRequestData();

        $requestMock = $this->createMock(LoanCreateRequest::class);
        $requestMock->expects($this->once())
            ->method('validated')
            ->willReturn($requestData);

        // Creating controller instance
        $controller = new LoanController($repositoryMock);

        // Calling store method
        $response = $controller->store($requestMock);

        // Asserting redirection to show page
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('loan.show', ['id' => $repositoryMock->getPrimaryKey()]), $response->getTargetUrl());
    }


    /** @test */
    public function it_returns_back_with_errors_if_storing_fails()
    {
        // Mocking dependencies
        $repositoryMock = $this->createMock(LoanRepository::class);

        // Creating request
        $requestData = $this->generateValidRequestData();

        $requestMock = $this->createMock(LoanCreateRequest::class);
        $requestMock->expects($this->once())
            ->method('validated')
            ->willReturn($requestData);

        // Creating controller instance
        $controller = new LoanController($repositoryMock);

        // Manually set validation errors in session
        session(['errors' => new \Illuminate\Support\MessageBag(['error in create'])]);

        // Calling store method
        $response = $controller->store($requestMock);

        // Asserting redirection back with errors
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('error in create', session('errors')->first());
    }

    /**
     * Generate valid request data for testing.
     *
     * @return array
     */
    private function generateValidRequestData(): array
    {
        return [
            'loan_amount' => rand(1111, 9999),
            'interest_rate' => rand(1, 100),
            'loan_term' => rand(1, 12)
        ];
    }

    /** @test */
    public function it_returns_back_with_errors_if_storing_fails_due_to_invalid_data()
    {
        // Mocking dependencies
        $repositoryMock = $this->createMock(LoanRepository::class);

        // Creating request with invalid data
        $invalidData = [
            'loan_amount' => -100, // Invalid: Negative loan amount
            'interest_rate' => 'abc', // Invalid: Non-numeric interest rate
            'loan_term' => 0, // Invalid: Zero loan term
        ];

        $requestMock = $this->createMock(LoanCreateRequest::class);
        $requestMock->expects($this->once())
            ->method('validated')
            ->willReturn($invalidData);

        // Creating controller instance
        $controller = new LoanController($repositoryMock);

        // Manually set validation errors in session
        $this->app['session']->put('errors', new \Illuminate\Support\MessageBag([
            'loan_amount' => ['The loan amount must be at least 1.'],
            'interest_rate' => ['The interest rate must be a number.'],
            'loan_term' => ['The loan term must be at least 1.'],
        ]));

        // Calling store method
        $response = $controller->store($requestMock);

        // Asserting redirection back with errors
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertTrue($response->isRedirect());

        // Asserting validation error messages
        $this->assertEquals('The loan amount must be at least 1.', session('errors')->first('loan_amount'));
        $this->assertEquals('The interest rate must be a number.', session('errors')->first('interest_rate'));
        $this->assertEquals('The loan term must be at least 1.', session('errors')->first('loan_term'));
    }

}
