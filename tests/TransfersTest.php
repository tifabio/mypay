<?php

use App\Models\Users;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TransfersTest extends TestCase
{
    use DatabaseTransactions;

    private $userModel;

    public function setUp(): void
    {
        parent::setUp();
        $this->userModel = $this->app->make(Users::class);
    }

    /**
     * Test if shopkeeper can't transfer
     * Users created by seed using fakeUsers (from UsersRepository)
     */
    public function testUserCanNotTransfer()
    {
        $this->post(route('transfer.save'), [
            'value' => '100',
            'payer' => '3',
            'payee' => '1'
        ])
        ->seeStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test if user has balance
     * Users created by seed using fakeUsers (from UsersRepository)
     */
    public function testUserHasBalance()
    {
        $this->post(route('transfer.save'), [
            'value' => '600',
            'payer' => '1',
            'payee' => '2'
        ])
        ->seeStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test valid transfer
     * Users created by seed using fakeUsers (from UsersRepository)
     */
    public function testValidTransfer()
    {
        $payer_id = 1;
        $payee_id = 2;

        $this->post(route('transfer.save'), [
            'value' => '200',
            'payer' => $payer_id,
            'payee' => $payee_id
        ])
        ->seeStatusCode(Response::HTTP_CREATED);

        $this->assertEquals(300, $this->userModel->find($payer_id)->balance);
        $this->assertEquals(250, $this->userModel->find($payee_id)->balance);
    }
}