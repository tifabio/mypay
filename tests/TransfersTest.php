<?php

class TransfersTest extends TestCase
{
    public function testUserCanNotTransfer()
    {
        $this->post(route('transfer.save'), [
            'value' => '100',
            'payer' => '3',
            'payee' => '1'
        ])
        ->seeStatusCode(422);
    }

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