    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('store_settings', function (Blueprint $table) {
                $table->id();
                $table->string('store_name')->nullable();
                $table->text('store_address')->nullable();
                $table->text('bank_details')->nullable();
                $table->decimal('shipping_cost', 15, 2)->default(0.00);
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('store_settings');
        }
    };
    
