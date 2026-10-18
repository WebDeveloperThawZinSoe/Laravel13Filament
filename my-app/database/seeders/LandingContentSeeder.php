<?php

namespace Database\Seeders;

use App\Models\LandingContent;
use Illuminate\Database\Seeder;

class LandingContentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            // ===== BRAND =====
            ['brand', 'site_name',    ['title' => 'ပေါက်ပျော်', 'content' => "Myanmar's Premium Betting Agent"]],
            ['brand', 'site_logo',    ['image_url' => 'https://pautpyaw.com/logo.png']],

            // ===== HERO =====
            ['hero', 'badge',        ['title' => "Myanmar's #1 Trusted Agent", 'icon' => 'fas fa-shield-alt']],
            ['hero', 'title',        ['title' => 'ပေါက်ပျော်', 'subtitle' => 'Premium Betting Agent']],
            ['hero', 'description',  ['content' => 'Myanmar နိုင်ငံ၏ အယုံကြည်ဆုံး၊ လုံခြုံဆုံး Online Betting Agent ထံမှ ကံစမ်းမည် အနိုင်ရချင်သူများအတွက် အကောင်းဆုံးနေရာ']],
            ['hero', 'btn_primary',  ['link_url' => 'https://t.me/PautPyaw', 'link_text' => 'ဆက်သွယ်ရန်', 'icon' => 'fab fa-telegram']],
            ['hero', 'btn_secondary', ['link_url' => '#how-to-join', 'link_text' => 'အဖွဲ့ဝင်နည်း သိရှိရန်', 'icon' => 'fas fa-user-plus']],

            // ===== STATS =====
            ['stats', 'stat_members', ['icon' => '👥', 'value' => '50000', 'extra_value' => '+',    'title' => 'Member များ']],
            ['stats', 'stat_trust',   ['icon' => '🏆', 'value' => '99',    'extra_value' => '%',    'title' => 'Trust Rating']],
            ['stats', 'stat_speed',   ['icon' => '⚡', 'value' => '5',     'extra_value' => 'min',  'title' => 'min ငွေသွင်း/ထုတ်']],
            ['stats', 'stat_support', ['icon' => '💎', 'value' => '24/7',  'extra_value' => '',     'title' => 'Customer Support']],

            // ===== SERVICES =====
            ['services', 'service_1', ['title' => 'ကျွဲဂိမ်း',         'content' => 'ကျွဲဂိမ်းကို အကောင်းဆုံးနှုန်းထားများဖြင့် လွယ်ကူစွာ ကစားနိုင်ပါသည်။', 'icon' => 'fas fa-bolt',        'link_url' => 'https://t.me/PautPyaw', 'link_text' => 'အကောင့်ဖွင့်ရန်']],
            ['services', 'service_2', ['title' => 'စလေ့ာဂိမ်း',       'content' => 'စလေ့ာဂိမ်းများကို အမျိုးအစားစုံလင်စွာဖြင့် ကစားနိုင်ပါသည်။',          'icon' => 'fas fa-gamepad',     'link_url' => 'https://t.me/PautPyaw', 'link_text' => 'အကောင့်ဖွင့်ရန်']],
            ['services', 'service_3', ['title' => 'လိုက်ကာစီနို',     'content' => 'Real Dealer နှင့် တိုက်ရိုက် Live Casino ဂိမ်းများကို ကစားနိုင်ပါသည်။', 'icon' => 'fas fa-play-circle', 'link_url' => 'https://t.me/PautPyaw', 'link_text' => 'အကောင့်ဖွင့်ရန်']],
            ['services', 'service_4', ['title' => 'ရှမ်းကိုးမီး ဘူကြီး', 'content' => 'ရှမ်းကိုးမီး ဘူကြီးကို အထူးနှုန်းထားဖြင့် ကစားနိုင်ပါသည်။',        'icon' => 'fas fa-fire',        'link_url' => 'https://t.me/PautPyaw', 'link_text' => 'အကောင့်ဖွင့်ရန်']],

            // ===== STEPS =====
            ['steps', 'step_1', ['value' => '01', 'icon' => 'fas fa-mobile-alt',     'title' => 'ဆက်သွယ်ပါ',      'content' => 'Telegram သို့မဟုတ် Viber မှတဆင့် ကျွန်ုပ်တို့ Agent ထံ ဆက်သွယ်ပါ']],
            ['steps', 'step_2', ['value' => '02', 'icon' => 'fas fa-file-signature', 'title' => 'အကောင့်ဖွင့်ပါ',   'content' => 'သင့်အမည်နှင့် ဖုန်းနံပါတ်ဖြင့် Account တစ်ခု ဖွင့်ပေးပါမည်']],
            ['steps', 'step_3', ['value' => '03', 'icon' => 'fas fa-wallet',         'title' => 'ငွေသွင်းပါ',      'content' => 'KBZ Pay, Wave Pay, AYA Pay မှတဆင့် လွယ်ကူစွာ ငွေသွင်းနိုင်သည်']],
            ['steps', 'step_4', ['value' => '04', 'icon' => 'fas fa-dice',           'title' => 'ကစားပါ & အနိုင်ရပါ', 'content' => 'သင်နှစ်သက်ရာကစားပြီး ကံကောင်းပါစေ!']],

            // ===== PROMOTIONS =====
            ['promotions', 'promo_1', ['title' => 'Welcome Bonus',  'content' => 'ပထမဦးဆုံး ငွေသွင်းမှုတွင် 50% Bonus ရရှိမည်',   'value' => '50%', 'extra_value' => 'Max: 100,000 Ks', 'icon' => '🎁', 'link_text' => 'HOT']],
            ['promotions', 'promo_2', ['title' => 'Daily Cashback', 'content' => 'နေ့တိုင်း ရှုံးသွားသောငွေ၏ 1% Cashback ရရှိမည်', 'value' => '1%',  'extra_value' => 'Daily Reset',    'icon' => '💫']],
            ['promotions', 'promo_3', ['title' => 'VIP Reward',     'content' => 'VIP Member များအတွက် နှစ်ပတ်လည် Special Bonus',  'value' => '3%',  'extra_value' => 'VIP Only',       'icon' => '👑']],
            ['promotions', 'promo_4', ['title' => 'Referral Bonus', 'content' => 'သူငယ်ချင်းများ ညွှန်ပြသောအခါ Lifetime Commission', 'value' => '1%', 'extra_value' => 'Unlimited',      'icon' => '🤝']],

            // ===== TESTIMONIALS =====
            ['testimonials', 'testimonial_1',  ['title' => 'Aung Kyaw Zin',    'subtitle' => 'Member since 2025',    'content' => 'ငွေသွင်းငွေထုတ် အမြန်ဆုံးနဲ့ Agent ကလည်း response မြန်တယ်။ ဘာမှ problem မရှိဘူး', 'value' => '5', 'extra_value' => 'A']],
            ['testimonials', 'testimonial_2',  ['title' => 'Ma Thida',         'subtitle' => 'VIP Member since 2024', 'content' => 'Slot Games တွေ အများကြီးပေးတယ်၊ Bonus လည်းကောင်းတယ်၊ ပေါက်ပျော်မှာပဲ ကစားမယ်', 'value' => '5', 'extra_value' => 'M']],
            ['testimonials', 'testimonial_3',  ['title' => 'Ko Htet Aung',     'subtitle' => 'Member since 2026',    'content' => 'Trust ရတဲ့ Agent ဆိုတော့ ရင်ဆိုင်ရတဲ့ ပြဿနာတွေ Agent ကပဲ ဖြေရှင်းပေးတယ်', 'value' => '5', 'extra_value' => 'K']],
            ['testimonials', 'testimonial_4',  ['title' => 'Su Myat Noe',      'subtitle' => 'Member since 2025',    'content' => 'ကျွဲဂိမ်းနဲ့ စလေ့ာဂိမ်းတွေ ဆော့ရတာ အရမ်းအဆင်ပြေတယ်။ ငွေထုတ်တာလည်း အမြန်ရတယ်။', 'value' => '5', 'extra_value' => 'S']],

            // ===== AGENT =====
            ['agent', 'agent_feature_1', ['title' => 'Commission ကောင်း', 'content' => 'မိမိ ရောင်းအားပေါ်မူတည်ပြီး ညှိနှိုင်းပါသည်', 'icon' => 'fas fa-coins']],
            ['agent', 'agent_feature_2', ['title' => 'လွယ်ကူသောစနစ်',    'content' => 'Online မှတဆင့် Member များကို စီမံနိုင်သည်', 'icon' => 'fas fa-laptop']],
            ['agent', 'agent_feature_3', ['title' => '၂၄ နာရီ ပံ့ပိုး',     'content' => 'Agent များအတွက် Support အမြဲပေးနေမည်',   'icon' => 'fas fa-clock']],
            ['agent', 'agent_feature_4', ['title' => 'Bonus ထပ်ရမည်',      'content' => 'ကြိုးစားမှုပေါ်မူတည်ပြီး Bonus ထပ်ပေးပါမည်', 'icon' => 'fas fa-medal']],
            ['agent', 'agent_btn_viber',    ['link_url' => 'viber://chat?number=%2B959400453990', 'link_text' => 'Viber မှဆက်သွယ်ပါ',    'icon' => 'fab fa-viber']],
            ['agent', 'agent_btn_telegram', ['link_url' => 'https://t.me/PautPyaw',                'link_text' => 'Telegram မှဆက်သွယ်ပါ', 'icon' => 'fab fa-telegram']],

            // ===== CONTACT =====
            ['contact', 'contact_telegram', ['title' => 'Telegram',      'content' => '@PautPyaw',   'icon' => 'fab fa-telegram', 'link_url' => 'https://t.me/PautPyaw']],
            ['contact', 'contact_phone',    ['title' => 'Phone / Viber', 'content' => '09400453990', 'icon' => 'fas fa-phone-alt', 'link_url' => 'tel:09400453990']],
            ['contact', 'payment_kbz',  ['title' => 'KBZ Pay']],
            ['contact', 'payment_wave', ['title' => 'Wave Money']],
            ['contact', 'payment_aya',  ['title' => 'AYA Pay']],
            ['contact', 'payment_bank', ['title' => 'Bank Transfer']],

            // ===== FOOTER =====
            ['footer', 'footer_brand',   ['title' => 'ပေါက်ပျော်', 'content' => "Myanmar's Premium Betting Agent", 'image_url' => 'https://pautpyaw.com/logo.png']],
            ['footer', 'footer_badge_1', ['value' => '18+']],
            ['footer', 'footer_badge_2', ['value' => 'Gamble Responsibly']],
            ['footer', 'footer_badge_3', ['value' => 'For Entertainment Purposes Only']],
        ];

        foreach ($rows as $i => [$section, $key, $attrs]) {
            LandingContent::updateOrCreate(
                ['section' => $section, 'item_key' => $key],
                array_merge($attrs, ['sort_order' => $i, 'is_active' => true])
            );
        }
    }
}