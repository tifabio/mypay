<?php

use App\Models\UserType;
use App\Repositories\UserRepository;
use App\Services\TransferService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TransferTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /**
     * @var TransferService $transferService
     */
    private $transferService;

    /**
     * @var array $user
     */
    private $user;

    /**
     * @var array $shopkeeper
     */
    private $shopkeeper;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this->app->make(UserRepository::class);
        $this->transferService = $this->app->make(TransferService::class);

        $this->user = [
            'name' => 'Joao',
            'document' => '66900839002',
            'email' => 'joao@teste.dev',
            'password' => Hash::make('joao@123'),
            'balance' => 500.00,
            'user_types_id' => UserType::TYPE_USER
        ];

        $this->shopkeeper = [
            'name' => 'Pedro',
            'document' => '29268732000149',
            'email' => 'pedro@teste.dev',
            'password' => Hash::make('pedro@123'),
            'balance' => 50.00,
            'user_types_id' => UserType::TYPE_SHOPKEEPER
        ];
    }

    /**
     * Test if shopkeeper can't transfer
     */
    public function testUserCanNotTransfer()
    {
        $payer = $this->userRepository->save($this->shopkeeper);
        $payee = $this->userRepository->save($this->user);

        $this->json('POST', route('transfer.create'), [
            'value' => 100,
            'payer' => $payer->id,
            'payee' => $payee->id
        ])->seeStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test if user has balance
     */
    public function testUserHasBalance()
    {
        $payer = $this->userRepository->save($this->user);
        $payee = $this->userRepository->save($this->shopkeeper);

        $this->json('POST', route('transfer.create'), [
            'value' => 600,
            'payer' => $payer->id,
            'payee' => $payee->id
        ])->seeStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test invalid value
     */
    public function testInvalidValue()
    {
        $payer = $this->userRepository->save($this->user);
        $payee = $this->userRepository->save($this->shopkeeper);

        $this->json('POST', route('transfer.create'), [
            'value' => -50,
            'payer' => $payer->id,
            'payee' => $payee->id
        ])->seeStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test required fields
     */
    public function testRequiredFields()
    {
        $payer = $this->userRepository->save($this->user);
        $payee = $this->userRepository->save($this->shopkeeper);

        $this->json('POST', route('transfer.create'), [
            'payer' => $payer->id,
            'payee' => $payee->id
        ])->seeStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->json('POST', route('transfer.create'), [
            'value' => -50,
            'payee' => $payee->id
        ])->seeStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);


        $this->json('POST', route('transfer.create'), [
            'value' => -50,
            'payer' => $payer->id,
        ])->seeStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test valid transfer
     */
    public function testValidTransfer()
    {
        $payer = $this->userRepository->save($this->user);
        $payee = $this->userRepository->save($this->shopkeeper);

        $this->json('POST', route('transfer.create'), [
            'value' => 200,
            'payer' => $payer->id,
            'payee' => $payee->id
        ])->seeStatusCode(Response::HTTP_CREATED);

        $this->assertEquals(300, $this->userRepository->find($payer->id)->balance);
        $this->assertEquals(250, $this->userRepository->find($payee->id)->balance);
    }

    /**
     * Test revert transfer
     */
    public function testRevertTransfer()
    {
        $payer = $this->userRepository->save($this->user);
        $payee = $this->userRepository->save($this->shopkeeper);

        $this->json('POST', route('transfer.create'), [
            'value' => 200,
            'payer' => $payer->id,
            'payee' => $payee->id
        ])->seeStatusCode(Response::HTTP_CREATED);

        $this->assertEquals(300, $this->userRepository->find($payer->id)->balance);
        $this->assertEquals(250, $this->userRepository->find($payee->id)->balance);

        $response = json_decode($this->response->getContent());
        $this->transferService->revert($response->id);

        $this->assertEquals(500, $this->userRepository->find($payer->id)->balance);
        $this->assertEquals(50, $this->userRepository->find($payee->id)->balance);
    }
}