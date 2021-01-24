<?php
    define('API_KEY', '1552197392:AAGKN5quXP--VsACTr9q7jGS21lcBs_nl0o');

    $admin = "941327405"; // admin idsi
    $adminuser = "mrAkhmadov"; // admin user

    function del($nomi){
        array_map('unlink', glob("step/$nomi.*"));
    }
    function put($fayl, $nima){
        file_put_contents("$fayl", "$nima");
    }

    function pstep($cid,$zn){
        file_put_contents("step/$cid.step",$zn);
    }

    function step($cid){
        $step = file_get_contents("step/$cid.step");
        $step += 1;
        file_put_contents("step/$cid.step",$step);
    }

    function nextTx($cid,$txt){
        $step = file_get_contents("step/$cid.txt");
        file_put_contents("step/$cid.txt","$step\n$txt");
    }

    function ty($ch){
        return bot('sendChatAction', [
            'chat_id' => $ch,
            'action' => 'typing',
        ]);
    }

    function ACL($callbackQueryId, $text = null, $showAlert = false)
    {
        return bot('answerCallbackQuery', [
            'callback_query_id' => $callbackQueryId,
            'text' => $text,
            'show_alert' => $showAlert,
        ]);
    }

    function bot($method,$datas=[]){
        $url = "https://api.telegram.org/bot".API_KEY."/".$method;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
        $res = curl_exec($ch);
        if(curl_error($ch)){
            var_dump(curl_error($ch));
        }else{
            return json_decode($res);
        }
    }

    $update = json_decode(file_get_contents('php://input'));
    $message = $update->message;
    $cid = $message->chat->id;
    $cidtyp = $message->chat->type;
    $miid = $message->message_id;
    $name = $message->chat->first_name;
    $user = $message->from->username;
    $tx = $message->text;
    $callback = $update->callback_query;
    $mmid = $callback->inline_message_id;
    $mes = $callback->message;
    $mid = $mes->message_id;
    $cmtx = $mes->text;
    $mmid = $callback->inline_message_id;
    $idd = $callback->message->chat->id;
    $cbid = $callback->from->id;
    $cbuser = $callback->from->username;
    $data = $callback->data;
    $ida = $callback->id;
    $cqid = $update->callback_query->id;
    $cbins = $callback->chat_instance;
    $cbchtyp = $callback->message->chat->type;
    $step = file_get_contents("step/$cid.step");
    $menu = file_get_contents("step/$cid.menu");
    $stepe = file_get_contents("step/$cbid.step");
    $menue = file_get_contents("step/$cbid.menu");
    // mkdir("step");

    $otex = "😔 Bekor qilish";

    $keys = json_encode([
        'resize_keyboard'=>true,
        'keyboard' => [
            [['text' => "🎓 Kurslar"],],
            [['text' => "ℹ️ Biz haqimizda"],['text' => "📞 Aloqa"],],
            [['text' => "📍 Manzil"],['text' => "®️ Ro`yhatdan o`tish"],],
        ]
    ]);

    $otmen = json_encode([
        'resize_keyboard'=>true,
        'keyboard'=>[
            [['text'=>"$otex"],],
        ]
    ]);

    $manzil = json_encode(
        ['inline_keyboard' => [
        [['callback_data' => "😊 Awesome", 'text' => "😊 Awesome"],['callback_data' => "😕 So-so", 'text' => "😕 So-so"],],
        ]
    ]);

    $kurs = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "🖥 Front End"], ['text' => "💻 Back End"],],
            [['text' => "🐍 Python (Django)"], ['text' => "🕹 Go Lang"],],
            [['text' => "🔙 Ortga qaytish"],],
        ]
    ]);

    $tasdiq = json_encode(
        ['inline_keyboard' => [
            [['callback_data' => "ok", 'text' => "Ha 👍"],['callback_data' => "clear", 'text' => "Yo'q 👎"],],
        ]
    ]);

    if(isset($tx)){
        ty($cid);
    }



    if($tx == "/start"){
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*Assalomu alaykum, $name!* Sizga qanday yordam bera olishim mumkin?",
            'parse_mode' => 'markdown',
            'reply_markup' => $keys,
        ]);
    }
    if ($tx == "ℹ️ Biz haqimizda") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*Code Leader o'zi nima ?*\n\nCode Leader loyihasi dasturlash yo'nalishidagi O'zbekistondagi eng yosh o'quv loyihalaridan biri bo'lib, qisqa muddat ichida o'z o'rnini tobora topib borayotgan muvaffaqiyatli loyihala hisoblanadi.Loyiha tasnifida dasturlash tillari, xususan PHP, Python kabi jahondagi eng ommabop dasturlash tillaridan yuqori darajadagi darslar tashkil etilgan.Loyihada nafaqat dasturlash balki dasturlashdan tashqari, o'quvchilar o'zlarida liderlik qobiliyatini ham rivojlantirib olish imkoniyatiga ega bo'ladilar.Turli xil seminarlar, janglar, hackaton barchasi bizda!\n\n*📊 Natijalar*: Hozirda 50 dan oshiq o'quvchilar ushbu kursni tamomlagan holda IT sohasida o'z yo'nalishlarini topib borishmoqda.Eng qizig'i shundaki darslarda o'zlarini ko'rsatgan, masalalarga o'zgacha yechim beradigan, o'z ustida ishlashda to'xtamaydigan o'quvchilar 100% jamoaga taklif etiladi.Hozirda o'quv loyiha doirasidan biz bilan hamkorlikda ish boshlagan talabalar soni 10 dan oshdi!\n\n*🗞 So'nggi Yangiliklar*: Shu yildan lohiya doirasida siz 🐍 Python (Django), 🕹 Go Lang - Go dasturlash tili bo'yicha ham bilim olish imkoniyatiga egasizlar!",
            'parse_mode' => 'markdown',
            'reply_markup' => $keys,
        ]);
    }

    if ($tx == "📞 Aloqa") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*Biz bilan bog'lanish: *\n\n*📞 Tel.: +998(97) 462-21-61\n📧 E-mail: infocodeleader@gmail.com\n*🌐 Sayt: [http://www.codeleader.uz]\n\n*Ijtimoiy tarmoqlar:*\nTelegram: [t.me/thetechguide]\nFacebook: [facebook.com/codeleaderuz]\nInstagram: [instagram.com/_codeleader]",
            'parse_mode' => 'markdown',
            'reply_markup' => $keys,
        ]);
    }
    if ($tx == "📍 Manzil") {
        bot('sendLocation', [
            'chat_id' => $cid,
            'latitude' => 41.326387,
            'longitude' => 69.229802,
            'reply_markup' => $keys,
        ]);
    }
   

    // Kurs haqida ma'lumot
    if ($tx == "🎓 Kurslar") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*Aynan qaysi yo'nalishdagi kursimiz haqida ma'lumot kerak ?*",
            'parse_mode' => 'markdown',
            'reply_markup' => $kurs,
        ]);
    }

    if ($tx == "🖥 Front End") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*📚 Texnologiyalar : HTML5, CSS3, SASS, Javascript & jQuery, Bootstrap4, Agile, Scrum/Kanban, Trello, Jira, IT resume.*\n\n👨🏻‍💻 Jarayon: Umumiy kurs 3 oy muddatni o'z ichiga olib, shu muddat ichida siz eng sodda vebsite maketlardan tortib eng murakkablarigacha bemalol yasay olasiz.Bundan tashqari jQuery qismida online magazin loyihasi ustida ishlaysiz, kurs so'ngida siz 6+ loyihadan tashkil topgan portfolioga ega bo'lgan holda kursni yakunlaysiz.\n\n🎁 Bonus : Kurs davomida dasturlashdan tashqari, o'quvchilar o'zlarida liderlik qobiliyatini ham rivojlantirib olishadi.Turli xil seminarlar, janglar, hackaton barchasi sizni kutmoqda shoshiling!Darslarda o'zlarini ko'rsatgan, masalalarga o'zgacha yechim beradigan, o'z ustida ishlashda to'xtamaydigan o'quvchilar 100% jamoaga taklif etiladi.\n\n📉 Qo'shimcha : O'zingizda hech qanday o'sish his qilmasangiz,  pulingiz 100% qaytariladi. ",
            'parse_mode' => 'markdown',
            'reply_markup' => $kurs,
        ]);
    }

    if ($tx == "💻 Back End") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*📚 Texnologiya: Javascript, jQuery, PHP, MySQL, Git, Yii2/Laravel, Agile, Scrum/Kanban, Trello, Jira, Telegram bot, IT resume.*\n\n👨🏻‍💻 Jarayon: Back end kursimiz 4 oy muddatni tashkil etadi, kurs davomida siz saytlarning dinamik qismi ustida ishlashni *PHP* dasturlash tilida o'rganasiz. Faqatgina dinamik saytlar emas, balki  online magazin, kichik CRM dasturlarini ham bemalol qura olish imkoniyatiga ega bo'lasiz.\n\n🎁 Bonus : Kurs davomida dasturlashdan tashqari, o'quvchilar o'zlarida liderlik qobiliyatini ham rivojlantirib olishadi.Turli xil seminarlar, janglar, hackaton barchasi sizni kutmoqda shoshiling!Darslarda o'zlarini ko'rsatgan, masalalarga o'zgacha yechim beradigan, o'z ustida ishlashda to'xtamaydigan o'quvchilar 100% jamoaga taklif etiladi.\n\n📉 Qo'shimcha : O'zingizda hech qanday o'sish his qilmasangiz,  pulingiz 100% qaytariladi.",
            'parse_mode' => 'markdown',
            'reply_markup' => $kurs,
        ]);
    }

    if ($tx == "🐍 Python (Django)") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*📚 Texnologiya: 🐍 Python (Django)*\n\n👨🏻‍💻 Jarayon: Kurs 5 oy muddatni tashkil etadi.Kurs davomida siz  telegram bot, Django da e-shop (online magazin), kichik CRM va shu kabi ko'plab loyihalar ustida ishlaysiz.\n\n🎁 Bonus : Kurs davomida dasturlashdan tashqari, o'quvchilar o'zlarida liderlik qobiliyatini ham rivojlantirib olishadi.Turli xil seminarlar, janglar, hackaton barchasi sizni kutmoqda shoshiling!Darslarda o'zlarini ko'rsatgan, masalalarga o'zgacha yechim beradigan, o'z ustida ishlashda to'xtamaydigan o'quvchilar 100% jamoaga taklif etiladi.\n\n📉 Qo'shimcha : O'zingizda hech qanday o'sish his qilmasangiz,  pulingiz 100% qaytariladi.",
            'parse_mode' => 'markdown',
            'reply_markup' => $kurs,
        ]);
    }

    if ($tx == "🕹 Go Lang") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*📚 Texnologiya: 🕹 Go Lang - Go dasturlash tili *\n\n👨🏻‍💻 Jarayon: Kurs 2 oy muddatni o'zi ichiga olgan holda siz telegram bot, microservislar bilan ishlash mahoratini o'zingizda shakllantirishingiz mumkin.\n\n🎁 Bonus : Kurs davomida dasturlashdan tashqari, o'quvchilar o'zlarida liderlik qobiliyatini ham rivojlantirib olishadi.Turli xil seminarlar, janglar, hackaton barchasi sizni kutmoqda shoshiling!Darslarda o'zlarini ko'rsatgan, masalalarga o'zgacha yechim beradigan, o'z ustida ishlashda to'xtamaydigan o'quvchilar 100% jamoaga taklif etiladi.\n\n📉 Qo'shimcha : O'zingizda hech qanday o'sish his qilmasangiz,  pulingiz 100% qaytariladi.",
            'parse_mode' => 'markdown',
            'reply_markup' => $kurs,
        ]);
    }

    if ($tx == "🔙 Ortga qaytish") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Sizga qanday yordam bera olishim mumkin?",
            'parse_mode' => 'markdown',
            'reply_markup' => $keys,
        ]);
    }

    // register uchun
    if($tx == "®️ Ro`yhatdan o`tish"){
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Ismingiz?\n(Masalan : John)",
            'parse_mode' => 'markdown',
            'reply_markup' => $otmen,
        ]);
        pstep($cid,"0");
        put("step/$cid.menu","register");
    }

    if($step == "0" and $menu == "register"){
        if($tx == $otex){}else{
            bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Yoshingiz\n(Masalan : 20)",
                'parse_mode' => 'markdown',
                'reply_markup' => $otmen,
            ]);
        nextTx($cid, "🎓 Shogird: ". $tx);
        step($cid);
        }
    }

    if($step == "1" and $menu == "register"){
        if($tx == $otex){}else{
            bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Qaysi yo'nalish bo'yicha tahsil olmoqchisiz?\n(Masalan : Front End, Back End...)",
                'parse_mode' => 'markdown',
                'reply_markup' => $otmen,
            ]);
        nextTx($cid, "🌐 Yosh: ".$tx);
        step($cid);
        }
    }

    if($step == "2" and $menu == "register"){
        if($tx == $otex){}else{
            bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Tanlagan yo'nalishingiz bo'yicha bilim darajangiz qanday?\n(Masalan : Umuman yo'q, Oz-moz bilaman...)",
                'parse_mode' => 'markdown',
                'reply_markup' => $cancel,
            ]);
            nextTx($cid, "📚 Texnologiya: ".$tx);
            step($cid);
        }
    }

    if($step == "3" and $menu == "register"){
        bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Telefon raqamingizni kiriting?\n(Masalan : +99897 1234567)",
                'parse_mode' => 'markdown',
                'reply_markup' => $cancel,
            ]);
        nextTx($cid, "👨🏻‍💻 Daraja: ".$tx);
        step($cid);
    }

    if($step == "4" and $menu == "register"){
        if($tx == $otex){}else{
            if(mb_stripos($tx,"9989")!==false){
            bot('sendMessage', [
                    'chat_id'=>$cid,
                    'text'=>"*Ma'lumotlar muvaffaqiyatli saqlandi*, Iltimos bot faoliyatini baholang?",
                    'parse_mode'=>'markdown',
                    'reply_markup' => $manzil,
                ]);
                nextTx($cid, "📞 Aloqa: ".$tx);
                step($cid);
            }else{
                bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Telefon raqamingizni kiriting?\n(Masalan : 99897 1234567)",
                'parse_mode' => 'markdown',
                'reply_markup' => $cancel,
            ]);
            }
        }
    }

    if(isset($data) and $stepe == "5" and $menue == "register"){
        ACL($ida);
        $baza = file_get_contents("step/$cbid.txt");
        bot('sendMessage',[
            'chat_id'=>$cbid,
            'text'=>"<b>Sizning Anketa tayyor bo'ldi, barchasi ma'lumotlaringiz tasdiqlaysizmi?</b>
            $baza\n☑️ Rating : $data",
            'parse_mode'=>'html',
            'reply_markup'=>$tasdiq,
        ]);
        nextTx($cbid, "👌 Rating: ".$data);
        step($cbid);
    }

    if($data == "ok" and $stepe == "6" and $menue == "register"){
        ACL($ida);
        $baza = file_get_contents("step/$cbid.txt");
        bot('sendMessage',[
            'chat_id'=>$admin,
            'text'=>"<b>Yangi o'quvchi!</b>
            Username: @$cbuser
            <a href='tg://user?id=$cbid'>Zaxira profili</a><code>$baza</code>",
            'parse_mode'=>'html',
        ]);
        bot('sendMessage',[
            'chat_id'=>$cbid,
            'text'=>"✅ Sizning Anketangiz xodimlarimizga muvaffaqiyatli jo'natildi, qisqa fursatlarda sizga aloqaga chiqamiz! E'tiboringiz uchun rahmat",
            'parse_mode'=>'html',
            'reply_markup'=>$keys,
        ]);
        del($cbid);
    }
    if($tx == $otex or $data == "clear"){
    ACL($ida);
    del($cbid);
    del($cid);
    if(isset($tx)) $url = "$cid";
    if(isset($data)) $url = "$cbid";
    bot('sendMessage', [
    'chat_id'=>$url,
    'text'=>"Anketa bekor qilindi!",
    'reply_markup'=>$keys,
    ]);
    }

?>