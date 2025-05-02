<?php

namespace Database\Seeders;

use App\Domain\News\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $investors = [
            'saylor', 'novogratz', 'galaxydigital', 'Grayscale', 'PanteraCapital',
            'a16z', 'Fidelity', 'Grayscale', 'paradigm', 'Bitwise', 'BlackRock',
            'LarryFink', 'PolychainCapital', 'multicoincap', 'BinanceLabs',
            'galaxydigital', 'circle', 'DWFLabs', 'ag_dwf'
        ];

        $projects = [
            'adam3us', 'BitcoinMagazine', 'VitalikButerin', 'ConsenSys', 'cz_binance', 'binance', 'bgarlinghouse', 'chrislarsensf',
            'IOHK_Charles', 'Cardano_CF', 'dogecoin', 'aeyakovenko', 'solana', 'gavofyork', 'Polkadot', 'justinsuntron', 'SatoshiLite',
            'el33th4xor', 'avax', 'sandeepnailwal', '0xPolygon', 'Shibtoken', 'zmanian', 'cosmos', 'SergeyNazarov', 'chainlink', 'haydenzadams',
            'Uniswap', 'silviomicali', 'Algorand', 'JedMcCaleb', 'StellarOrg', 'StaniKulechov', 'ManceHarmon', 'hedera', 'SuiNetwork', 'DomWilliams',
            'dfinity', 'ilblackdragon', 'NEARProtocol', 'ton_blockchain', 'durov', 'borgetsebastien', 'TheSandboxGame', 'wormhole'
        ];

        $educational = [
            'CoinDesk', 'TheBlock__', 'decryptmedia', 'CryptoSlate', 'Cointelegraph', 'Bitcoinist', 'CryptoNews', 'Investingcom'
        ];

        $analytical = [
            'MessariCrypto', 'Delphi_Digital', 'Dune', 'chainalysis', 'santimentfeed', 'arkham', 'cryptoquant_com', 'intotheblock',
            'glassnode', 'coinglass_com', 'WhalePanda'
        ];

        foreach ($investors as $nickname) {
            Account::firstOrCreate(['nickname' => $nickname], ['type' => 'investor']);
        }
        foreach ($projects as $nickname) {
            Account::firstOrCreate(['nickname' => $nickname], ['type' => 'project']);
        }
        foreach ($educational as $nickname) {
            Account::firstOrCreate(['nickname' => $nickname], ['type' => 'educational']);
        }
        foreach ($analytical as $nickname) {
            Account::firstOrCreate(['nickname' => $nickname], ['type' => 'analytical']);
        }

    }
}
