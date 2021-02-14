<?php

use App\Models\User;
use App\Services\TransferService;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TransferTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var User $userModel
     */
    private $userModel;

    /**
     * @var TransferService $transferService
     */
    private $transferService;

    public function setUp(): void
    {
        parent::setUp();
        $this->userModel = $this->app->make(User::class);
        $this->transferService = $this->app->make(TransferService::class);
    }

    /**
     * Test if shopkeeper can't transfer
     * Users created by seed using fakeUsers (from UsersRepository)
     */
    public function testUserCanNotTransfer()
    {
        $this->json('POST', route('transfer.create'), [
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
        $this->json('POST', route('transfer.create'), [
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

        $this->json('POST', route('transfer.create'), [
            'value' => '200',
            'payer' => $payer_id,
            'payee' => $payee_id
        ])
        ->seeStatusCode(Response::HTTP_CREATED);

        $this->assertEquals(300, $this->userModel->find($payer_id)->balance);
        $this->assertEquals(250, $this->userModel->find($payee_id)->balance);
    }

    /**
     * Test revert transfer
     * Users created by seed using fakeUsers (from UsersRepository)
     */
    public function testRevertTransfer()
    {
        $payer_id = 1;
        $payee_id = 2;

        $this->json('POST', route('transfer.create'), [
            'value' => '200',
            'payer' => $payer_id,
            'payee' => $payee_id
        ])
        ->seeStatusCode(Response::HTTP_CREATED);

        $this->assertEquals(300, $this->userModel->find($payer_id)->balance);
        $this->assertEquals(250, $this->userModel->find($payee_id)->balance);

        $response = json_decode($this->response->getContent());
        $this->transferService->revert($response->id);

        $this->assertEquals(500, $this->userModel->find($payer_id)->balance);
        $this->assertEquals(50, $this->userModel->find($payee_id)->balance);
    }
}