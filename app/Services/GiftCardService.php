<?php

namespace App\Services;

use App\Notifications\GiftCardGenerated;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
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
        $url = route('filament.admin.resources.gift-cards.manage', [
            'record' => $this->giftCard->id,
            'code' => $this->giftCard->code,
        ]);

        $qr_code = base64_encode(
            QrCode::format('png')
                ->size(300)
                ->color(94, 59, 73)
                ->generate($url)
        );

        try {
            $buyer = new Buyer([
                'amount' => $this->giftCard->remaining_amount,
                'expires_at' => $this->giftCard->expires_at,
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

            FilamentNotification::make()
                ->title(__('Pdf sent successfully'))
                ->success()
                ->send();

            return redirect()->route('filament.admin.resources.gift-cards.manage', [
                'record' => $this->giftCard,
                'code' => $this->giftCard->code,
            ]);
        } catch (Exception $e) {
            Log::error(__('Failed to generate or send PDF: ') . $e->getMessage());
            throw $e;
        }
    }
}
