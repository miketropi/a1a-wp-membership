import Web3 from 'web3';

((w) => {
  'use strict';
  const abi = require('./abi.json');
  const RECIPIENT_ADDRESS = '0x0926B26Cd6014Bb6CD446Fb78ae2A3c64876412B';
  const buttonPayment = document.querySelector('#web3-payment');
  if(!buttonPayment) return;

  const ENVIRONMENTS = {
    production: {
      chainId: 1, // Ethereum Mainnet
      usdtAddress: '0xdac17f958d2ee523a2206206994597c13d831ec7',
      rpcUrl: 'https://mainnet.infura.io/v3/b88737e3056844edae4d5753b63dd6d3'
    },
    testnet: {
      chainId: 11155111, // Sepolia
      usdtAddress: '0xaA8E23Fb1079EA71e0a56F48a2aA51851D8433D0', //'0x7169D38820dfd117B3D6016CAbFb7d8D5B49DE1A', // USDT Sepolia Test
      rpcUrl: 'https://sepolia.infura.io/v3/b88737e3056844edae4d5753b63dd6d3'
    }
  };

  const web3 = new Web3(window.ethereum || Web3.givenProvider);

  async function checkNetwork(envType) {
    const chainId = await web3.eth.getChainId();
    const expectedChainId = ENVIRONMENTS[envType].chainId;
    
    if (Number(chainId) !== expectedChainId) {
      const networkName = envType === 'production' ? 'Ethereum Mainnet' : 'Sepolia';
      throw new Error(`Vui lòng chuyển sang ${networkName}`);
    }
  }

  async function connectWallet() {
    // Kiểm tra MetaMask đã cài đặt
    if (!window.ethereum) {
      alert('Vui lòng cài đặt MetaMask!');
      return;
    }

    try {
      // Yêu cầu kết nối ví
      await window.ethereum.request({ 
        method: 'eth_requestAccounts' 
      });

      // Lấy danh sách tài khoản
      const accounts = await web3.eth.getAccounts();
      if (accounts.length === 0) {
        throw new Error('Vui lòng mở khóa ví MetaMask');
      }
      
      return accounts[0];
    } catch (error) {
      console.error('Lỗi kết nối ví:', error);
      throw error;
    }
  }

  async function transferUSDT(envType, amount, recipient) {
    try {
      // Check network
      await checkNetwork(envType);

      // Connect wallet & get account
      const sender = await connectWallet();
      if (!sender) return;

      // Init contract USDT
      const USDT_ABI = abi;
      const usdtContract = new web3.eth.Contract(
        USDT_ABI,
        ENVIRONMENTS[envType].usdtAddress
      );

      console.log('usdtContract', usdtContract);

      // Convert amount (USDT has 6 decimals)
      const amountInWei = web3.utils.toBigInt(amount * 10**6);
      console.log('amountInWei', amountInWei);

      // Check balance 
      const balance = await usdtContract.methods.balanceOf(sender).call();
      console.log('balance', balance);
      
      if (web3.utils.toBigInt(balance) < web3.utils.toBigInt(amountInWei)) {
        throw new Error('Không đủ số dư USDT');
      }

      console.log('Số dư USDT:', web3.utils.fromWei(balance, 'ether'));
      // return;

      // Create transaction
      const tx = usdtContract.methods.transfer(recipient, amountInWei.toString());
      const gas = await tx.estimateGas({ from: sender });
      const gasPrice = await web3.eth.getGasPrice();
      console.log('Gas:', gas);
      console.log('Gas Price:', gasPrice);
      console.log('Gas Price (Gwei):', web3.utils.fromWei(gasPrice, 'gwei'))
      // Send transaction
      const receipt = await tx.send({
        from: sender,
        gas: 300000,
        gasPrice: (BigInt(gasPrice)  * 120n / 100n).toString(), // 120% of the current gas price
      });

      return receipt.transactionHash;

    } catch (error) {
      console.error(`[${envType.toUpperCase()} Error]`, error);
      throw error;
    }
  }

  document.querySelector('#web3-payment').addEventListener('click', async () => {
    try {
      const txHash = await transferUSDT(
        'testnet',
        20, // Số lượng USDT  
        RECIPIENT_ADDRESS // Địa chỉ nhận
      );
      alert(`Testnet TX: https://sepolia.etherscan.io/tx/${txHash}`);
    } catch (error) {
      alert(`Lỗi Testnet: ${error.message}`);
    }
  });
})(window)