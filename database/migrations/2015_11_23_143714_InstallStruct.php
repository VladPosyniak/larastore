<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class InstallStruct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //




//        Schema::create('user_address', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('address_name');
//            $table->integer('user_id');
//            $table->string('city');
//            $table->string('country');
//            $table->text('address');
//            $table->integer('postal_code');
//            $table->string('company')->nullable();
//            $table->text('comment')->nullable();
//            $table->timestamp('created_at');
//
//        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cover')->nullable();
            $table->string('urlhash'); // add index
            $table->integer('sort_id');
            $table->integer('class_id');
            $table->timestamps();
        });

        Schema::create('category_description', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id');
            $table->integer('category_id');
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->timestamps();
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cover')->nullable();
            $table->string('urlhash'); // add index
            $table->integer('sort_id');
            $table->timestamps();
        });

        Schema::create('class_description', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id')->nullable();
            $table->integer('language_id')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->timestamps();
        });

        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discount');
            $table->integer('user_id');
            $table->dateTime('expiration_date');
            $table->timestamps();
        });

        Schema::create('currency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->char('prefix');
            $table->float('coefficient');
            $table->dateTime('expiration_date');
            $table->char('symbol')->nullable();
            $table->timestamps();
        });

//        Schema::create('clients', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name');
//            $table->string('email');
//            $table->string('tel');
//            $table->timestamps();
//        });

        Schema::create('filter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('filter_group_id');
            $table->string('value');
            $table->timestamps();
        });


        Schema::create('filter_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('filter_class_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('language', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->boolean('status');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('option_group_id');
            $table->string('value');
            $table->float('price');
            $table->integer('quantity');
            $table->timestamps();
        });

        Schema::create('option_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('ordered_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('amount');
            $table->string('options')->nullable();
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('status');
            $table->string('code')->unique();
            $table->enum('currency',['UAH','USD','RUB']);
            $table->text('delivery_address');
            $table->enum('pay_type',['liqpay','balance','cash']);
            $table->tinyInteger('paid')->default(0);
            $table->float('to_pay');
            $table->integer('coupon_id')->nullable();
            $table->tinyInteger('to_processing')->default(0);
            $table->timestamps();
        });

        Schema::create('parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('parameters_description', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id');
            $table->integer('parameter_id');
            $table->string('title')->nullable();
            $table->string('unit')->nullable();
            $table->timestamps();
        });

        Schema::create('parameters_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('items_id');
            $table->integer('parameters_id');
            $table->integer('language_id');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cover')->nullable();
//            $table->string('sku')->nullable();
            $table->integer('price')->nullable();
            $table->string('price_old')->nullable();
            $table->string('quantity')->nullable();
//            $table->string('label')->nullable();
            $table->enum('isset', ['true', 'false'])->default('true');
            $table->enum('visible', ['true', 'false'])->default('true');
//            $table->string('urlhash'); // add index
            //$table->integer('parent_id');
            $table->integer('sort_id');
            $table->integer('categories_id');
            $table->integer('class_id');
            $table->timestamps();
        });


        Schema::create('products_description', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('language_id');
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('keywords')->nullable();
            $table->longText('description')->nullable();
            $table->text('description_full')->nullable();
            $table->timestamps();
        });


        Schema::create('product_filter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('filter_id');
            $table->timestamps();
        });

        Schema::create('product_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('option_id');
            $table->timestamps();
        });

        Schema::create('recommendsProducts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('product_id_recommend');
            $table->timestamps();

        });

        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('identificator');
            $table->text('data');
            $table->string('type');
            $table->timestamps();

        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('role',['customer','manager','admin'])->default('customer');
            $table->string('password', 60);
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('vkontakte_id')->nullable();
            $table->string('linkedin_id')->nullable();
            $table->float('balance')->default(0);
            $table->string('phone')->nullable();
            $table->string('locale')->nullable();
            $table->string('currency')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address_name');
            $table->integer('user_id');
            $table->string('city');
            $table->string('address');
            $table->string('country');
            $table->string('postal_code')->nullable();
            $table->string('company')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });

        Schema::create('user_event', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('visitor_registry', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip', 32);
            $table->string('country', 4)->nullable();
            $table->integer('clicks')->unsigned()->default(0);
            $table->timestamps();
        });








//        Schema::create('attribute', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name');
//            $table->integer('attribute_group_id');
//        });
//
//        Schema::create('attribute_group', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name');
//        });
//
//        Schema::create('product_attribute', function (Blueprint $table) {
//            $table->integer('product_id');
//            $table->integer('attribute_id');
//            $table->text('value');
//        });

//        Schema::create('additional', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name');
//            $table->string('description');
//            $table->string('price')->nullable();
//            $table->timestamps();
//        });



//        Schema::create('comments', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('product_id');
//            $table->string('name');
//            $table->string('email');
//            $table->longText('msg');
//            $table->enum('approve', ['true', 'false'])->default('false');
//            $table->timestamps();
//        });








//        Schema::create('orders', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('client_id');
//            $table->string('delivery_city');
//            $table->string('delivery_adr')->nullable();
//            $table->string('delivery_np')->nullable();
//            $table->enum('delivery_type', ['adr', 'np'])->default('np');
//            $table->enum('pay_type', ['nal', 'privat24', 'privat_terminal', 'liqpay'])->default('privat24');
//            $table->string('code'); // add index
//            $table->string('ttn')->nullable();
//
//            $table->longText('comment')->nullable();
//            $table->enum('status', ['new', 'paid', 'sent'])->default('new');
//
//            $table->timestamps();
//        });


//        Schema::create('order_items', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('order_id');
//            $table->string('product_id');
//            $table->integer('qty');
//            $table->timestamps();
//        });
//
//        Schema::create('order_files', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('order_id');
//            $table->string('name')->nullable();
//            $table->string('hash')->nullable();
//            $table->string('mime')->nullable();
//            $table->string('extension')->nullable();
//            $table->enum('status', ['tmp', 'success'])->default('tmp');
//            $table->enum('image', ['true', 'false'])->default('false');
//            $table->timestamps();
//        });
//
//
//        Schema::create('order_add', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('order_id');
//            $table->string('additional_id');
//            $table->timestamps();
//        });
//
//
//        Schema::create('NPCity', function (Blueprint $table) {
//            $table->string('name');
//            $table->string('ref');
//        });
//
//        Schema::create('NPUnit', function (Blueprint $table) {
//            $table->string('name');
//            $table->string('ref');
//        });
//
//        Schema::create('info', function (Blueprint $table) {
//            $table->increments('id');
//            $table->longText('text');
//            $table->timestamps();
//        });
//
//        Schema::create('gallery', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('filename');
//            $table->integer('sort_id');
//            $table->timestamps();
//        });
//
//        Schema::create('jobs', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->string('queue');
//            $table->longText('payload');
//            $table->tinyInteger('attempts')->unsigned();
//            $table->tinyInteger('reserved')->unsigned();
//            $table->unsignedInteger('reserved_at')->nullable();
//            $table->unsignedInteger('available_at');
//            $table->unsignedInteger('created_at');
//            $table->index(['queue', 'reserved', 'reserved_at']);
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::drop('jobs');
//        Schema::drop('gallery');
//        Schema::drop('info');
        Schema::drop('NPUnit');
        Schema::drop('NPCity');
//        Schema::drop('order_add');
//     php
//        Schema::drop('order_items');
        Schema::drop('orders');
        Schema::drop('clients');
//        Schema::drop('comments');
        Schema::drop('recommendsProducts');
//        Schema::drop('additional');
        Schema::drop('products');
        Schema::drop('product_filter');
        Schema::drop('filter');
        Schema::drop('filter_group');
        Schema::drop('classes');
        Schema::drop('categories');
        Schema::drop('password_resets');
        Schema::drop('users');
        Schema::drop('visitor_registry');
        Schema::drop('categories_description');
        Schema::drop('class_description');
        Schema::drop('coupons');
        Schema::drop('currency');
        Schema::drop('language');
        Schema::drop('options');
        Schema::drop('option_groups');
        Schema::drop('ordered_products');
        Schema::drop('parameters');
        Schema::drop('parameters_description');
        Schema::drop('parameters_values');
        Schema::drop('products_description');
        Schema::drop('product_options');
        Schema::drop('sliders');
        Schema::drop('user_address');
        Schema::drop('user_event');
    }
}
