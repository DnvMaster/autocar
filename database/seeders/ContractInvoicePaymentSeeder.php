<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContractInvoicePaymentSeeder extends Seeder
{
   public function run(): void
    {
        $rentals = Rental::orderBy('id')->get();
        if ($rentals->isEmpty()) {
            return;
        }
        foreach ($rentals as $index => $rental) {
            $startAt = Carbon::parse($rental->start_at);
            $contract = Contract::updateOrCreate(
                ['rental_id' => $rental->id],
                [
                    'contract_number' => 'AC-' . $startAt->format('Y') . '-' . str_pad($index + 1, 5, '0', STR_PAD_LEFT),
                    'file_path' => null,
                    'signed_at' => $rental->status === 'pending' ? null : $startAt->copy()->subDays(2),
                    'status' => match ($rental->status) {
                        'completed' => 'completed',
                        'active' => 'active',
                        'confirmed' => 'active',
                        default => 'draft',
                    },
                ]
            );
            $subtotal = (float) $rental->total;
            $tax = round($subtotal * 0.19, 2);
            $total = round($subtotal + $tax, 2);
            $issuedAt = $startAt->copy()->subDays(3);
            $dueAt = $issuedAt->copy()->addDays(14);
            $invoiceStatus = match (true) {
                $rental->status === 'completed' => 'paid',
                $rental->status === 'active' => 'issued',
                $rental->status === 'confirmed' => 'issued',
                default => 'draft',
            };
            $paidAt = $invoiceStatus === 'paid' ? $issuedAt->copy()->addDays(5) : null;
            Invoice::updateOrCreate(
                ['rental_id' => $rental->id],
                [
                    'invoice_number' => 'INV-' . $startAt->format('Y') . '-' . str_pad($index + 1, 5, '0', STR_PAD_LEFT),
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $total,
                    'status' => $invoiceStatus,
                    'issued_at' => $issuedAt,
                    'due_at' => $dueAt,
                    'paid_at' => $paidAt,
                ]
            );
            $paymentStatus = match ($invoiceStatus) {
                'paid' => 'completed',
                'issued' => $rental->status === 'active' ? 'completed' : 'pending',
                default => 'pending',
            };
            $paymentAmount = match ($invoiceStatus) {
                'paid' => $total,
                'issued' => $rental->status === 'active' ? round($total * 0.50, 2): 0,
                default => 0,
            };
            $paymentMethod = match ($index % 4) {
                0 => 'bank_transfer',
                1 => 'card',
                2 => 'online',
                default => 'cash',
            };
            Payment::updateOrCreate(
                ['rental_id' => $rental->id],
                [
                    'amount' => $paymentAmount,
                    'payment_method' => $paymentMethod,
                    'status' => $paymentStatus,
                    'transaction_id' => $paymentStatus === 'completed' ? 'TXN-' . strtoupper(str()->random(12)) : null,
                    'paid_at' => $paymentStatus === 'completed' ? $paidAt : null,
                    'notes' => match ($invoiceStatus) {
                        'paid' => 'Invoice paid in full.',
                        'issued' => 'Payment awaiting customer.',
                        'overdue' => 'Invoice payment is overdue.',
                        default => 'Payment not yet required.',
                    },
                ]
            );
        }
    }
}
