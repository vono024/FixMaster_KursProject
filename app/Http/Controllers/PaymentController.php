<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showPaymentForm(RepairRequest $repair)
    {
        if (!$repair->canBePaidBy(auth()->user())) {
            abort(403, 'Ви не можете оплатити цю заявку');
        }

        return view('payments.form', compact('repair'));
    }

    public function processPayment(Request $request, RepairRequest $repair)
    {
        if (!$repair->canBePaidBy(auth()->user())) {
            abort(403, 'Ви не можете оплатити цю заявку');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:card,cash,online',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validated['amount'] != $repair->final_cost) {
            return back()->with('error', 'Сума оплати не відповідає вартості ремонту');
        }

        sleep(2);

        $success = rand(1, 10) > 1;

        if ($success) {
            $repair->update([
                'amount' => $validated['amount'],
                'payment_status' => 'paid',
                'payment_method' => $validated['payment_method'],
                'paid_at' => now(),
            ]);

            return redirect()->route('repairs.show', $repair)
                ->with('success', 'Оплату успішно здійснено! Дякуємо за використання наших послуг.');
        } else {
            return back()
                ->with('error', 'Помилка обробки платежу. Спробуйте ще раз або оберіть інший спосіб оплати.')
                ->withInput();
        }
    }
}
