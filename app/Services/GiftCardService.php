<?php

namespace App\Services;

use App\Notifications\GiftCardGenerated;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GiftCardService
{
    public function __construct(
        public Model $giftCard,
    )
    {
        //
    }

    /**
     * @throws BindingResolutionException
     */
    public function generatePdf()
    {
        $plainToken = Str::uuid();

        $url = route('admin.gift-cards.validate', [
            'record' => $this->giftCard->id,
            'token' => $plainToken, // Use plain token here
        ]);

        $qr_code = base64_encode(
            QrCode::format('png')
                ->size(300)
                ->color(94, 59, 73)
                ->generate($url)
        );

        $this->giftCard->update([
            'token' => Hash::make($plainToken),
            'token_expire_at' => now()->addYears(2),
        ]);

        try {
            $buyer = new Buyer([
                'balance' => $this->giftCard->amount,
                'end_date' => $this->giftCard->expires_at,
                'qr_code' => $qr_code,
            ]);

            $placeholderItem = InvoiceItem::make('Gift Card')->pricePerUnit(0);

            $giftCard = Invoice::make()
                ->buyer($buyer)
                ->addItem($placeholderItem);

            $giftCard->stream();

            $pdf = Pdf::loadView('pdf.gift-card', compact('giftCard'));

            $fileName = now()->format('Y_m_d') . '_gift_card_' . $this->giftCard->id . '.pdf';
            $pdfPath = 'tmp/' . $fileName;

            Storage::put($pdfPath, $pdf->output());

            Notification::route('mail', $this->giftCard->email_gift ?? $this->giftCard->email)
                ->notify(new GiftCardGenerated($giftCard, Storage::path($pdfPath)));

            Storage::delete($pdfPath);

            return redirect()->route('filament.admin.resources.gift-cards.edit', ['record' => $this->giftCard]);
        } catch (Exception $e) {
            Log::error(__('Failed to generate or send PDF: ') . $e->getMessage());
            throw $e;
        }
    }
}
