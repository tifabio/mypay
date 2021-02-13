<?php

class TransfersTest extends TestCase
{
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
        ->seeStatusCode(422);
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
        ->seeStatusCode(422);
    }
}