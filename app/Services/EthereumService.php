<?php

namespace App\Services;

use Web3\Web3;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Illuminate\Support\Facades\Log;

class EthereumService
{
    protected $web3;
    protected $contract;

    public function __construct()
    {
        // Initialize Web3 and Contract instances
        $provider = new HttpProvider(new HttpRequestManager(config('blockchain.ethereum_rpc_url'), 10));
        $this->web3 = new Web3($provider);
        $this->contract = new Contract($provider, config('blockchain.contract_abi', []));

        // Get the contract address from configuration
        $contractAddress = config('blockchain.contract_address');

        // Validate the contract address before setting it
        if (!$this->isValidEthereumAddress($contractAddress)) {
            // Log the error and return a meaningful response
            Log::error('Invalid Ethereum contract address configured: ' . $contractAddress);
            return; // Optionally, you can throw an exception or handle it differently.
        }

        // Set the contract address
        $this->contract->at($contractAddress);
    }

    // Method to validate Ethereum address
    protected function isValidEthereumAddress($address)
    {
        return is_string($address) && preg_match('/^0x[a-fA-F0-9]{40}$/', $address);
    }

    public function createProduct($name, $location)
    {
        $this->contract->send('createProduct', $name, $location, ['from' => config('blockchain.ethereum_private_key')]);
    }

    public function updateProductLocation($id, $location)
    {
        $this->contract->send('updateProductLocation', $id, $location, ['from' => config('blockchain.ethereum_private_key')]);
    }
}
