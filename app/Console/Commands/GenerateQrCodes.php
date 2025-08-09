<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateQrCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qr:generate {--user-id= : Generate QR code for specific user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate QR codes for users who don\'t have them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->option('user-id');

        if ($userId) {
            $user = User::find($userId);
            if (!$user) {
                $this->error("User with ID {$userId} not found.");
                return 1;
            }
            $this->generateQrCode($user);
            $this->info("QR code generated for user: {$user->name}");
            return 0;
        }

        $users = User::whereNull('qr_code')->orWhere('qr_code', '')->get();
        
        if ($users->isEmpty()) {
            $this->info('All users already have QR codes.');
            return 0;
        }

        $this->info("Generating QR codes for {$users->count()} users...");

        $bar = $this->output->createProgressBar($users->count());
        $bar->start();

        foreach ($users as $user) {
            $this->generateQrCode($user);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('QR codes generated successfully!');

        return 0;
    }

    /**
     * Generate QR code for a user
     */
    private function generateQrCode(User $user)
    {
        $qrData = url("/confirm_meal/{$user->id}");
        $qrPath = "qrcodes/{$user->id}_qrcode.svg";
        
        // Create qrcodes directory if it doesn't exist
        $qrDirectory = public_path('qrcodes');
        if (!file_exists($qrDirectory)) {
            mkdir($qrDirectory, 0755, true);
        }

        QrCode::format('svg')
            ->size(200)
            ->generate($qrData, public_path($qrPath));

        $user->qr_code = $qrPath;
        $user->save();
    }
} 