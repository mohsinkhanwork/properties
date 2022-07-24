<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('time_zone');
            $table->string('site_name');
            $table->string('site_email');
            $table->string('site_logo');
            $table->string('site_favicon');
            $table->string('google_map_key');
            $table->integer('recaptcha');
            $table->string('recaptcha_secret_key');
            $table->string('recaptcha_site_key');
            $table->string('site_description');
            $table->text('site_keywords');
            $table->text('site_header_code');
            $table->text('site_footer_code');
            $table->string('site_copyright');
            $table->string('footer_widget1_title');
            $table->text('footer_widget1');
            $table->string('footer_widget2_title');
            $table->text('footer_widget2');
            $table->string('footer_widget3_title');
            $table->text('footer_widget3');
            $table->string('title_bg');
            $table->string('all_properties_layout');
            $table->string('map_latitude');
            $table->string('map_longitude');
            $table->string('home_properties_layout');
            $table->string('featured_properties_layout');
            $table->string('sale_properties_layout');
            $table->string('rent_properties_layout');
            $table->integer('pagination_limit');
            $table->text('addthis_share_code');
            $table->text('disqus_comment_code');
            $table->string('social_facebook');
            $table->string('social_twitter');
            $table->string('social_linkedin');
            $table->string('social_instagram');
            $table->string('contact_lat');
            $table->string('contact_long');
            $table->string('contact_us_title');
            $table->string('contact_us_email');
            $table->string('contact_us_phone');
            $table->string('contact_us_address');
            $table->string('terms_conditions_title');
            $table->text('terms_conditions_description');
            $table->string('privacy_policy_title');
            $table->text('privacy_policy_description');
            $table->string('currency_sign');
            $table->string('currency_code');
            $table->float('tax_percentage');
            $table->integer('paypal_payment_on_off');
            $table->string('paypal_mode');
            $table->string('paypal_client_id');
            $table->string('paypal_secret');
            $table->integer('stripe_payment_on_off');
            $table->string('stripe_secret_key');
            $table->integer('razorpay_payment_on_off');
            $table->string('razorpay_key');
            $table->string('razorpay_secret');
            $table->integer('paystack_payment_on_off');
            $table->string('paystack_secret_key');
            $table->float('featured_property_price');
            $table->text('bank_payment_details');
            $table->string('invoice_company');
            $table->string('invoice_address');
            $table->string('smtp_host');
            $table->string('smtp_port');
            $table->string('smtp_email');
            $table->string('smtp_password');
            $table->string('smtp_encryption');
            $table->string('gdpr_cookie_title');
            $table->string('gdpr_cookie_text');
            $table->string('gdpr_cookie_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
