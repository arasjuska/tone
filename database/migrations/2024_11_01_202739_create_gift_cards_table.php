<?php

use App\Enums\GiftCardStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedTinyInteger('status')->default(GiftCardStatus::ACTIVE->value);
            $table->decimal('amount', 10);
            $table->decimal('remaining_amount', 10);
            $table->string('email');
            $table->string('email_gift')->nullable();
            $table->unsignedTinyInteger('expiration_months')->default(12);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_cards');
    }
};
