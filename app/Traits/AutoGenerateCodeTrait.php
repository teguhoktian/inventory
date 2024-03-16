<?php

namespace App\Traits;

trait AutoGenerateCodeTrait
{
    protected function generateCode($modelClass, $prefix = 'JB')
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $lastCode = $this->getLastCode($modelClass, $prefix, $currentMonth, $currentYear);

        // Logika untuk menghasilkan kode baru
        if ($lastCode) {
            // Jika kode terakhir ada, maka ambil nomor urut terakhir
            $lastNumber = intval(substr($lastCode, -3));
            $newNumber = $lastNumber + 1;
            $code = $prefix . $currentMonth . $currentYear . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada kode sebelumnya, mulai dari nomor 1
            $code = $prefix . $currentMonth . $currentYear . '001';
        }

        return $code; // Kembalikan kode yang dihasilkan
    }

    protected function getLastCode($modelClass, $prefix, $currentMonth, $currentYear)
    {
        // Ambil kode terakhir dari database berdasarkan nama model yang diberikan
        $lastCode = $modelClass::where('kode', 'like', $prefix . $currentMonth . $currentYear . '%')
            ->orderBy('kode', 'desc')
            ->value('kode');

        return $lastCode;
    }
}
