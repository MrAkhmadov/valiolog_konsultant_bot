<?php 
    define('API_KEY', '1552197392:AAGKN5quXP--VsACTr9q7jGS21lcBs_nl0o');

    function del($nomi) {
        array_map('unclink', glob("step/$nomi.*"));
    }
    function put($fayl, $nima) {
        file_put_contents("$fayl", "$nima");
    }
    
    function pstep($cid, $zn) {
        file_put_contents("step/$cid.step", $zn);
    }

    function step($cid) {
        $step = file_get_contents("step/$cid.step");
        $step += 1;
        file_put_contents("step/$cid.step", $step);
    }

    function nextTx($cid, $txt) {
        $step = file_get_contents("step/$cid.txt");
        file_put_contents("step/$cid.txt", "$step\n$txt");
    }

    function ty($ch) {
        return bot('sendChatAction', [
            'chat_id' => $ch,
            'action' => 'typing',
        ]);
    }

    function ACL($callbackQueryId, $text = null, $showAlert = false) {
        return bot ('answerCallbackQuery', [
            'calback_query_id' => $callbackQueryId,
            'text' => $text,
            'show_alert' => $showAlert,
        ]);
    }

    function bot($method, $datas=[])
    {
        $url = "https://api.telegram.org/bot".API_KEY."/".$method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        $res = curl_exec($ch);
        if (curl_error($ch)) {
            var_dump(curl_error($ch));
        } else {
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
    $idd = $callback->message->chat->id;
    $cbid = $callback->from->id;
    $cbuser = $callback->from->username;
    $data = $callback->data;
    $ida = $callback->id;
    $cqib = $update->callback_query->id;
    $cbins = $callback->chat_instance;
    $cbchtyp = $callback->message->chat->type;
    $step = file_get_contents("step/$cid.step");
    $menu = file_get_contents("step/$cid.menu");
    $stepe = file_get_contents("step/$cbid.step");
    $menue = file_get_contents("step/$cbid.menu");
    //mkdir("step");

    $cencel  = "😔 Bekor qilish";

    $keys = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "💉Salomatlik kansepsiyasi"],],
            [['text' => "❓Savol Javob"], ['text' => "📞Aloqa"],],
            [['text' => "🎞Video"], ['text' => "🗣Audio"],],
        ]
    ]);

    $otmen  = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "$cencel"],],
        ]
    ]);

    $jinsi = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "👱‍♂️Erkak"], ['text' => "👩‍🦳Ayol"],],
            [['text' => "$cencel"],],
        ]
    ]);

    $manzil = json_encode(
        ['inline_keyboard' => [
        [['callback_data' => "Awesome", 'text' => "Awesome"], ['callback_data' => "So-So", 'text' => "So-so"],],
        ]    
    ]);

    $kurs = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "1 - Qoida"], ['text' => "2 - Qoida"],],
            [['text' => "3 - Qoida"], ['text' => "4 - Qoida"],],
            [['text' => "5 - Qoida"], ['text' => "🔙 Ortga qaytish"],],
        ]
    ]);

    $tasdiq = json_encode(
        ['inline_keyboard' => [
            [['callback_data' => "ok", 'text' => "Ha 👍"],['callback_data' => "clear", 'text' => "Yo'q 👎"],],
        ]
    ]);

    if (isset($tx)) {
        ty($cid);
    }

    if ($tx == "/start") {
        bot ('sendMessage', [
            'chat_id' => $cid,
            'text' => "*Assalomu alaykum, $name!* Sizga qanday yordam bera olishim mumkin?",
            'parse_mode' => 'markdown',
            'reply_markup' => $keys,
        ]);
    }

if ($tx == "🗣Audio") {
    bot ('sendVoice', [
        'chat_id' => $cid,
        'voice' => "https://t.me/valiolog_konsultant/20",
        'caption' => 'Suv va uning foydali hususiyatlari',
        'reply_markup' => $keys,
    ]);   
}

if ($tx == "📞Aloqa") {
    bot('sendMessage', [
        'chat_id' => $cid,
        'text' => '<a href="https://t.me/yulduzoy_sultonova">👥Bizning Guruh</a>
        <a href="https://t.me/valiolog_konsultant">📢Bizning kanal</a>',
        'parse_mode' => 'HTML',
        'reply_markup' => $keys,
    ]);
}

if ($tx == "🎞Video") {
    bot('sendVideo', [
        'chat_id' => $cid,
        'video' => "https://t.me/valiolog_konsultant/16",
        'caption' => "📹 Salomatlik Sirlari ko'rsatuvi 1-son.",
        'reply_markup' => $keys,
    ]);
}

if ($tx == "💉Salomatlik kansepsiyasi") {
    bot ('sendMessage', [
        'chat_id' => $cid,
        'text' => "Бир муддат ўйлаб кўрдингизми❓
        Соғлик нима❓
        Нима учун касал бўляпмиз❓
        Касаллик қаердан келиб чиқяпти❓
        Ва УЗОҚ  ЯШАШ ва СОҒЛОМ ҚАРИШ СИРЛАРИ НИМА❓❓
        
        Оддий 5 та *ОЛТИН* коидага амал қилишни ўрганинг  ва  соглом булинг🙏
        
        5 та ОЛТИН КОИДА👇👇
        
        *💥1-ПСИХОЛОГИЯ, РУХИЙ ХОЛАТНИ ИДОРА КИЛИШ.
        
        💥2-РАЦИОНАЛ, 5 МАХАЛ ТЎҒРИ ОВҚАТЛАНИШ.
        
        💥3-ТИРИК СУВ ИЧИШ ТАРТИБИ.
        
        💥4-ОРГАНИЗМНИ ТОЗАЛАШ (йилига 2 - 3 марта)
        
        💥5-ХАРАКАТ (5 км ва ундан ортик юриш) 
        Батафсил 👇👇*",
        'parse_mode' => 'markdown',
        'reply_markup' => $kurs,
    ]);
}

if ($tx == "1 - Qoida") {
    bot ('sendPhoto', [
        'chat_id' => $cid, 
        'photo' => "https://t.me/valiolog_konsultant/9",
        'caption' => "1-қоида.
        Сув ичиш режимини ўрнатинг. Вазнингизни қишда 30 мл га,  ёзда 40 мл га  кўпайтиринг, чиққан сон сизнинг кун давомида оч қоринга  ичадиган нормангиз.(қишин ёзин, бир умр ). Масалан: 70 кг бўлсангиз, 70×30=2 литр 100 мл сув ҳозирги салқин пайтда сизнинг 1 кунлик нормангиз.",
        'reply_markup' => $kurs,
    ]);
}

if ($tx == "2 - Qoida") {
    bot ('sendPhoto', [
        'chat_id' => $cid, 
        'photo' => "https://t.me/valiolog_konsultant/10",
        'caption' => "2-қоида.
        Овкатланиш тартиби. 5 махал. Нонуштани, хар қандай шароитда хам,  асло ўтказиб юборманг. Кўпроқ табиий, парланган, димланган таомлар истеъмол килинг. Хом сабзавот, мевалар (1кунда 400гр сабзавот, 300гр мева),  Смузи  ичишни йўлга қўйинг. Смарт фут - Ақлли озуқалар истеъмол қилишни ўрганинг! Улар сизнинг организмингизни химояда ушлаб туради.",
        'reply_markup' => $kurs,
    ]);
}

if ($tx == "3 - Qoida") {
    bot ('sendPhoto', [
        'chat_id' => $cid, 
        'photo' => "https://t.me/valiolog_konsultant/11",
        'caption' => "3-қоида. 
        Тозаланиш. Йилида онгли равишда  ичаклар, қон томирлар , капилярларда, хужайра атрофида йигилиб колган туз, токсин, ёг, шлак, айниқса  паразит, инфекция, замбуруғ, бактерия, гижжа қурт ва уларнинг ахлатларидан  катталар йилда 2 марта, болаларимизни 3-4 марта  табиий, ишончли, сифатли маҳсулотларимиз билан  тозалаб туришни йўлга қўйинг. Ўртача бундай ифлосликларни ҳар бир инсонда 15 кг яқин бўлишини тиббиёт тасдиқлайди.",
        'reply_markup' => $kurs,
    ]);
}

if ($tx == "4 - Qoida") {
    bot ('sendPhoto', [
        'chat_id' => $cid, 
        'photo' => "https://t.me/valiolog_konsultant/12",
        'caption' => "4-қоида. 
        Харакат. Асосан пиёда  юришга одатланинг. Кунлик норма  5 км дан кам бўлмаслигига аҳамият қаратинг. Модда  алмашинувига,   организмни  хужайра  атрофидаги   токсинлардан     тозаланишига, лимфа системасининг тозаланишига ва организмингиздаги регенирация- хужайралар янгиланиши  жараёнининг сифатли бўлишига  ёрдам беринг.",
        'reply_markup' => $kurs,
    ]);
}

if ($tx == "5 - Qoida") {
    bot ('sendPhoto', [
        'chat_id' => $cid, 
        'photo' => "https://t.me/valiolog_konsultant/13",
        'caption' => "5-қоида. 
        Психология. Сизнинг ўз соғлиғингизга бўлган муносабатингиз !!! Соғлом бўлишингиз учун  энг аввало бу масъулиятни ўз зиммангизга олишингиз шарт!!! Чунки  соғлиғимиз бу бизнинг энг қимматли, энг катта бойлигимиздир!!! Сизни соғлигингиз сиздан бошқа ҳеч кимга керак эмаслигини унутманг!!!",
        'reply_markup' => $kurs,
    ]);
}

if ($tx == "🔙 Ortga qaytish") {
    bot ('sendMessage', [
        'chat_id' => $cid,
        'text' => "Sizga qanday yordam bera olishim mumkin",
        'parse_mode' =>  'markdown',
        'reply_markup' => $keys,
    ]);
 }

//Savol javob 

if ($tx == "❓Savol Javob") {
    bot('sendMessage', [
        'chat_id' => $cid,
        'text' => "Ismingizni?\n(Masalan: Akmal",
        'parse_mode' => 'markdown',
        'reply_markup' => $otmen,
    ]);
    pstep($cid, "0");
    put("step/$cid.menu", "register");
}

// Yoshi
if ($step == "0" && $menu == "register") {
	if ($tx == $cencel) {} else {
		bot ('sendMessage', [
		    'chat_id' => $cid,
			'text' => "Yoshingiz\n(Masalan: 20)",
			'parse_mode' => 'markdown',
			'reply_markup' => $otmen,
		]);
	nextTx($cid, "Mijoz ismi: ".$tx);
	step ($cid);
	}
}

// Savol
// if ($step == "1" && $menu == "register") {
//     if ($tx == $cencel) {} else {
//         bot ('sendMessage', [
//             'chat_id' => $cid,
//             'text' => "Savolingizni batafsil kiriting: ",
//             'parse_mode' => 'markdown',
//             'reply_markup' => $otmen,
//         ]);
//         nextTx($cid, "Mijoz yoshi: ".$tx);
//         step($cid);
//     }
// }

// // Mijoz fikri

// if ($step == "2" && $menu == "register") {
//     if ($tx == $cencel) {} else {
//             bot('sendMessage', [
//             'chat_id' => $cid,
//             'text' => "*Savolingiz qabul qilindi tez orada sizning savolingizga mutaxasislar javob berishadi.* \n Iltimos faoliyatini baholang.",
//             'parse_mode' => 'markdown',
//             'reply_markup' => $manzil,
//         ]);
//         nextTx($cid, "Savol: ".$tx);
//         step($cid);           
// }
// }

// if (isset ($data) and $stepe == "3" and $menue == "register") {
// 	ACL($ida);
// 	$baza = file_get_contents("step/$cbid.txt");
// 	bot('sendMessage', [
// 		'chat_id' => $cbid,
// 		'text' => "<b>Sizning Anketa tayyor bo'ldi, barcha ma'lumotlaringizni tasdiqlaysizmi?</b>
// 		$baza\n Rating: $data",
// 		'parse_mode' => 'html',
// 		'reply_markup' => $tasdiq,
// 	]);
// 	nextTx ($cbid, "Rating: " . $data);
// 	step ($cbid);
// }

// if ($data == "ok" and $stepe == "4" and $menue == "register") {
// 	ACL($ida);
// 	$baza = file_get_contents("step/$cbid.txt");
// 	bot ('sendMessage', [
// 		'chat_id' => $admin,
// 		'text' => "<b>Yangi o'quvchi!</b>
//             Username: @$cbuser
//             <a href='tg://user?id=$cbid'>Zaxira profili</a><code>$baza</code>",
// 			'parse_mode' => 'html',
// 	]);
// 	bot('sendMessage',[
//             'chat_id'=>$cbid,
//             'text'=>"✅ Sizning Anketangiz xodimlarimizga muvaffaqiyatli jo'natildi, qisqa fursatlarda sizga aloqaga chiqamiz! E'tiboringiz uchun rahmat",
//             'parse_mode'=>'html',
//             'reply_markup'=>$keys,
//         ]);
//         del($cbid);
// }

// if($tx == $cencel or $data == "clear"){
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


// if($step == "2" and $menu == "savoljavob"){
//     ACL($ida);
//     $baza = file_get_contents("step/$cbid.txt");
//     bot('sendMessage',[
//         'chat_id'=>"941327405",
//         'text'=>"<b>Yangi o'quvchi!</b>
//         Username: @$cbuser
//         <a href='tg://user?id=$cbid'>Zaxira profili</a><code>$baza</code>",
//         'parse_mode'=>'html',
//     ]);
//     bot('sendMessage',[
//         'chat_id'=>$cbid,
//         'text'=>"✅ Sizning Anketangiz xodimlarimizga muvaffaqiyatli jo'natildi, qisqa fursatlarda sizga aloqaga chiqamiz! E'tiboringiz uchun rahmat",
//         'parse_mode'=>'html',
//         'reply_markup'=>$keys,
//     ]);
//     del($cbid);
// }

// if($tx == $cencel or $data == "clear"){
//     ACL($ida);
//     del($cbid);
//     del($cid);
//     if(isset($tx)) $url = "$cid";
//     if(isset($data)) $url = "$cbid";
//     bot('sendMessage', [
//     'chat_id'=>$url,
//     'text'=>"Anketa bekor qilindi!",
//     'reply_markup'=>$keys,
//     ]);
//     }

  

?>