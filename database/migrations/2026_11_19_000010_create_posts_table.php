<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->nullable();
            $table->string('slug', 250)->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Product stock & pricing
            $table->string('sku_code', 100)->nullable();
            $table->string('bar_code', 100)->nullable();
            $table->integer('stock_out_limit')->default(0);
            $table->boolean('stock_status')->default(1);
            $table->integer('quantity')->nullable();
            $table->decimal('purchase_price', 10, 2)->default(0.00);
            $table->decimal('final_price', 10, 2)->default(0.00);
            $table->decimal('discount', 10, 2)->default(0.00);
            $table->string('discount_type', 20)->nullable();
            $table->decimal('regular_price', 10, 2)->default(0.00);
            $table->timestamp('offer_start_date')->nullable();
            $table->timestamp('offer_end_date')->nullable();
            $table->integer('min_order_quantity')->default(1);
            $table->integer('max_order_quantity')->nullable();

            // Weight & dimensions
            $table->string('weight_unit', 100)->nullable();
            $table->string('weight_amount', 50)->nullable();
            $table->string('dimensions_unit', 100)->nullable();
            $table->string('dimensions_length', 50)->nullable();
            $table->string('dimensions_width', 50)->nullable();
            $table->string('dimensions_height', 50)->nullable();
            $table->string('weight_per_pices', 100)->nullable();
            $table->decimal('weight_per_ices', 10, 3)->default(0.000);
            $table->decimal('weight_per_quantity', 10, 2)->default(0.00);

            // Flags
            $table->boolean('variation_status')->default(0);
            $table->boolean('pos_status')->default(0);
            $table->boolean('emi_status')->default(0);
            $table->boolean('digital_status')->default(0);
            $table->boolean('classified_status')->default(0);
            $table->string('product_source', 50)->nullable();
            $table->integer('brand_id')->nullable();
            $table->unsignedBigInteger('view')->default(0);
            $table->string('template', 100)->nullable();
            $table->bigInteger('sell_count')->default(0);
            $table->integer('type')->default(0)->comment('0=Page,1=Post, 2=Product');

            // SEO
            $table->string('seo_title', 191)->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keyword')->nullable();
            $table->text('search_key')->nullable();

            $table->string('status', 10)->default('temp')->comment('temp,active,inactive');
            $table->boolean('fetured')->default(0);
            $table->bigInteger('addedby_id')->nullable();
            $table->bigInteger('editedby_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->boolean('bestSale')->default(0);
            $table->boolean('running_feet')->default(0);
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
